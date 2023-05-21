import { encodeForAjax } from '../utilities/utilities.js';

export function openTicket() {
    const tickets = document.querySelectorAll('.ticket');

    if (tickets && !window.location.href.includes('ticket.php')) {
        tickets.forEach(ticket => {
            ticket.addEventListener('click', () => {
                window.location.href = 'ticket.php?id=' + ticket.querySelector('li:first-child p').textContent.substring(1);
            });
        });
    }
}

function closeAddHashtag() {
    document.addEventListener("click", (e) => {
        const newHashtag = document.getElementById("new-hashtag");
        const exception = document.getElementById("add-hashtag-button");

        if (newHashtag && !exception.contains(e.target)) {
            if (newHashtag.contains(e.target)) {
                return;
            }
            newHashtag.remove();
        }
    });
}

// To add a new hashtah, the agent/admin must press the # key
function addHashtag() {
    const addHashtagButton = document.getElementById('add-hashtag-button');

    if (addHashtagButton) {
        addHashtagButton.addEventListener('click', function (e) {
            const alreadyOpen = document.querySelector('#new-hashtag');
            if (!alreadyOpen) {
                const main = document.querySelector('.ticket');

                const newHashtagForm = document.createElement("form");
                newHashtagForm.id = "new-hashtag";
                newHashtagForm.method = "post";
                newHashtagForm.action = "../actions/action_new_hashtag.php";
                newHashtagForm.style.top = (parseInt(e.clientY) + parseInt(window.scrollY)).toString() + "px";
                newHashtagForm.style.left = (parseInt(e.clientX) + parseInt(window.scrollX) - 100).toString() + "px";

                // new hashtag csrf input
                const csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "csrf";
                csrf.value = document.getElementById("csrf").textContent;
                newHashtagForm.appendChild(csrf);

                // new hashtag ticket id input
                const ticketId = document.createElement("input");
                ticketId.type = "hidden";
                ticketId.name = "ticket-id";
                ticketId.value = document.getElementById("ticket-id").textContent.substring(1);
                newHashtagForm.appendChild(ticketId);

                // new hashtag title
                const hashtagTitle = document.createElement("h4");
                hashtagTitle.innerText = "New Hashtag";

                // new hashtag name input
                const hashtagNameInput = document.createElement("input");
                hashtagNameInput.type = "text";
                hashtagNameInput.name = "hashtag-name";
                hashtagNameInput.id = "hashtag-name";

                // new hashtag submit button
                const hashtagSubmitButton = document.createElement("button");
                hashtagSubmitButton.type = "submit";
                hashtagSubmitButton.innerText = "Submit";

                newHashtagForm.appendChild(hashtagTitle);
                newHashtagForm.appendChild(hashtagNameInput);
                newHashtagForm.appendChild(hashtagSubmitButton);

                main.appendChild(newHashtagForm);
            }
        });
    }
}

function changeStatus() {
    const ticketStatus = document.getElementById('ticket-status');

    if(ticketStatus) {
        ticketStatus.addEventListener('change', function() { 
            const ticketId = document.getElementById('ticket-id').textContent.substring(1);
            const statusId = document.getElementById('ticket-status').value;
            const csrf = document.getElementById('csrf').textContent;
            const departmentId = document.getElementById('ticket-department').value;
            const status = document.getElementById('ticket-status').options[document.getElementById('ticket-status').selectedIndex].text;

            if(status !== 'assigned') {
                const request = new XMLHttpRequest();
                request.open('post', '../actions/action_change_ticket_status.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send(encodeForAjax({ticketId: ticketId, statusId: statusId, csrf: csrf}));
                window.location.reload();
            }
            else {
               openAssignAgent(departmentId);
            }
        });
    }
}

function closeOpenAssignAgent() {
    document.addEventListener("click", (e) => {
        const assign = document.getElementById("assign-agent");

        if (assign) {
            if (assign.contains(e.target)) {
                return;
            }
            assign.remove();
            window.location.reload();
        }
    });
}

async function openAssignAgent(departmentId) {
    const responseAgents = await fetch('../api/data.php?data=agents');
    const responseUsersDepartments = await fetch('../api/data.php?data=users_departments');
    var agents = await responseAgents.json();
    const usersDepartments = await responseUsersDepartments.json();

    var agentsStay = [];
    usersDepartments.forEach(userDepartment => {
        agents.forEach(agent => {
            if((agent.username == userDepartment.user) && (userDepartment.department_id == departmentId) && !(agent in agentsStay)) {
                agentsStay.push(agent);
            }
        });
    });
    agents = agentsStay;

    const assignAgentDiv = document.createElement('div');
    assignAgentDiv.id = 'assign-agent';

    const assignAgentTitle = document.createElement('h4');
    assignAgentTitle.textContent = 'Assign Agent';
    assignAgentDiv.appendChild(assignAgentTitle);

    const assignAgentList = document.createElement('ul');
    assignAgentList.id = 'assign-agent-list';

    agents.forEach(agent => {
        const assignAgent = document.createElement('li');
        const assignAgentText = document.createElement('p');
        assignAgentText.textContent = agent.username;
        assignAgent.appendChild(assignAgentText);
        assignAgentList.appendChild(assignAgent);
    });

    assignAgentDiv.appendChild(assignAgentList);

    const assignAgentButton = document.createElement('button');
    assignAgentButton.id = 'assign-agent-button';
    assignAgentButton.textContent = 'Assign';
    assignAgentDiv.appendChild(assignAgentButton);

    const main = document.querySelector('.ticket');
    main.appendChild(assignAgentDiv);
    assignAgent();
    alteranteAssignedAgent();
}

function alteranteAssignedAgent() {
    const assignedAgentText = document.getElementById('assigned-agent').textContent;
    const assignedAgentList = document.querySelectorAll('#assign-agent-list li');

    assignedAgentList.forEach(agent => {
        if(agent.textContent == assignedAgentText) {
            agent.classList.add('selected');
        }
        agent.addEventListener('click', function() {
            assignedAgentList.forEach(agent => {
                agent.classList.remove('selected');
            });
            agent.classList.add('selected');
        });
    });
}

function assignAgent() {
    const assignAgentButton = document.getElementById('assign-agent-button');

    if(assignAgentButton) {
        assignAgentButton.addEventListener('click', function() {
            const ticketId = document.getElementById('ticket-id').textContent.substring(1);
            const statusId = document.getElementById('ticket-status').value;
            const assignedAgent = document.querySelector('#assign-agent-list li.selected p').textContent;
            const csrf = document.getElementById('csrf').textContent;

            const request = new XMLHttpRequest();
            request.open('post', '../actions/action_change_ticket_status.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(encodeForAjax({ticketId: ticketId, statusId: statusId, assignedAgent: assignedAgent, csrf: csrf}));
            window.location.reload();
        });
    }
}

function changeDepartment() {
    const department = document.getElementById('ticket-department');

    if(department) {
        department.addEventListener('change', function() { 
            const ticketId = document.getElementById('ticket-id').textContent.substring(1);
            const csrf = document.getElementById('csrf').textContent;
            const departmentId = department.value;
            const agent = document.getElementById('assigned-agent').textContent;

            const request = new XMLHttpRequest();
            request.open('post', '../actions/action_change_ticket_department.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(encodeForAjax({ticketId: ticketId, departmentId: departmentId, agent: agent, csrf: csrf}));
            window.location.reload();
        });
    }
}

openTicket();
addHashtag();
closeAddHashtag();
changeStatus();
closeOpenAssignAgent();
changeDepartment();