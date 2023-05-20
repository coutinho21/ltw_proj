import { buildTicket, isArray } from '../utilities/utilities.js';
import { openTicket } from './script.js';

function searchTickets() {
    const search = document.querySelector('.search-ticket');

    if (search) {
        search.addEventListener('input', async () => {
            const response = await fetch('../api/search_tickets.php?search=' + search.value);
            const data = await response.json();

            const tickets = document.querySelector('.tickets-list ul');
            tickets.innerHTML = '';

            data.forEach(ticket => {
                tickets.appendChild(buildTicket(ticket));
            });
            openTicket();
        });
    }
}

function filterTicketsByDepartments() {
    const departments = document.querySelectorAll('.departments > li');

    if (departments) {
        departments.forEach(department => {
            department.addEventListener('click', async () => {
                let getElemWithClass = document.querySelector('.active');
                if (getElemWithClass === department) {
                    department.classList.remove('active');
                    window.location.reload();
                }
                else if (getElemWithClass !== null) {
                    getElemWithClass.classList.remove('active');
                }
                department.classList.add('active');

                const response = await fetch('../api/filter_ticket_departments.php?department=' + department.querySelector('p').textContent);
                const data = await response.json();

                const tickets = document.querySelector('.tickets-list ul');
                tickets.innerHTML = '';
                
                data.forEach(ticket => {
                    tickets.appendChild(buildTicket(ticket));
                });
                openTicket();
            });
        });
    }
}

function buttonOpenFilters() {
    const button = document.getElementById('filters-button');

    if (button) {
        button.addEventListener('click', () => openFilters());
    }
}

function filtersClose() {
    document.addEventListener('click', function clickOutside(event) {
        const getFilters = document.getElementById('filters');
        const getDateFilter = document.getElementById('date-filter');
        const getAgentFilter = document.getElementById('agent-filter');
        const getStatusFilter = document.getElementById('status-filter');
        const getHashtagFilter = document.getElementById('hashtag-filter');
        const exceptionFilters = document.getElementById('filters-button');
        const exceptionDateFilter = document.getElementById('date-filter-li');
        const exceptionAgentFilter = document.getElementById('agent-filter-li');
        const exceptionStatusFilter = document.getElementById('status-filter-li');
        const exceptionHashtagFilter = document.getElementById('hashtag-filter-li');
        if (getFilters && !getDateFilter && !getAgentFilter && !getStatusFilter && !getHashtagFilter && !exceptionFilters.contains(event.target) && !getFilters.contains(event.target)) {
            getFilters.remove();
        }
        if (getDateFilter && getFilters && !getDateFilter.contains(event.target) && !exceptionDateFilter.contains(event.target)) {
            getDateFilter.remove();
        }
        if (getAgentFilter && getFilters && !getAgentFilter.contains(event.target) && !exceptionAgentFilter.contains(event.target)) {
            getAgentFilter.remove();
        }
        if (getStatusFilter && getFilters && !getStatusFilter.contains(event.target) && !exceptionStatusFilter.contains(event.target)) {
            getStatusFilter.remove();
        }
        if (getHashtagFilter && getFilters && !getHashtagFilter.contains(event.target) && !exceptionHashtagFilter.contains(event.target)) {
            getHashtagFilter.remove();
        }
    });
}

function openFilters() {
    const main = document.getElementById("filters-div");
    const getFilters = document.getElementById('filters');
    if (main && !getFilters) {
        // filters div
        const filters = document.createElement("div");
        filters.id = "filters";

        // filters title
        const title = document.createElement("h4");
        title.textContent = "Filter by:";
        filters.appendChild(title);

        // filters list
        const filtersList = document.createElement("ul");

        // date filter list item
        const dateFilter = document.createElement("li");
        dateFilter.id = "date-filter-li";
        dateFilter.onclick = openDateFilter;
        const dateFilterText = document.createElement("p");
        dateFilterText.textContent = "Date";
        dateFilter.appendChild(dateFilterText);
        filtersList.appendChild(dateFilter);

        // agent filter list item
        const agentFilter = document.createElement("li");
        agentFilter.id = "agent-filter-li";
        agentFilter.onclick = openAgentFilter;
        const agentFilterText = document.createElement("p");
        agentFilterText.textContent = "Assigned Agent";
        agentFilter.appendChild(agentFilterText);
        filtersList.appendChild(agentFilter);

        // status filter list item
        const statusFilter = document.createElement("li");
        statusFilter.id = "status-filter-li";
        statusFilter.onclick = openStatusFilter;
        const statusFilterText = document.createElement("p");
        statusFilterText.textContent = "Status";
        statusFilter.appendChild(statusFilterText);
        filtersList.appendChild(statusFilter);

        // hashtag filter list item
        const hashtagFilter = document.createElement("li");
        hashtagFilter.id = "hashtag-filter-li";
        hashtagFilter.onclick = openHashtagFilter;
        const hashtagFilterText = document.createElement("p");
        hashtagFilterText.textContent = "Hashtag";
        hashtagFilter.appendChild(hashtagFilterText);
        filtersList.appendChild(hashtagFilter);

        filters.appendChild(filtersList);

        main.appendChild(filters);
    }
}

async function retrieveDateFilterInput() {
    const dateFilterFrom = document.getElementById("date-filter-input-from").value;
    const dateFilterTo = document.getElementById("date-filter-input-to").value;

    const response = await fetch('../api/filters.php?filter=date&from=' + dateFilterFrom + '&to=' + dateFilterTo);
    const data = await response.json();

    const tickets = document.querySelector('.tickets-list ul');
    tickets.innerHTML = '';

    if(isArray(data)){
        data.forEach(ticket => {
            tickets.appendChild(buildTicket(ticket));
        });
        openTicket();
        return;
    }
    tickets.appendChild(buildTicket(data));
    openTicket();
}

function openDateFilter() {
    const main = document.getElementById("filters-div");

    if (main) {
        // dateFilter div
        const dateFilter = document.createElement("div");
        dateFilter.id = "date-filter";

        // dateFilter title
        const title = document.createElement("h4");
        title.textContent = "Filter by date";
        dateFilter.appendChild(title);

        // dateFilter label from
        const labelFrom = document.createElement("label");
        labelFrom.textContent = "From";
        dateFilter.appendChild(labelFrom);

        // dateFilter input from
        const inputFrom = document.createElement("input");
        inputFrom.type = "date";
        inputFrom.id = "date-filter-input-from";
        dateFilter.appendChild(inputFrom);

        // dateFilter label to
        const labelTo = document.createElement("label");
        labelTo.textContent = "To";
        dateFilter.appendChild(labelTo);

        // dateFilter input to
        const inputTo = document.createElement("input");
        inputTo.type = "date";
        inputTo.id = "date-filter-input-to";
        dateFilter.appendChild(inputTo);

        // dateFilter button
        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveDateFilterInput;
        dateFilter.appendChild(button);

        main.appendChild(dateFilter);
    }
}

async function retrieveAgentFilterInput() {
    const agentFilterInput = document.getElementById("agent-filter-input").value;

    const response = await fetch('../api/filters.php?filter=agent&agent=' + agentFilterInput);
    const data = await response.json();

    const tickets = document.querySelector('.tickets-list ul');
    tickets.innerHTML = '';

    if(isArray(data)){
        data.forEach(ticket => {
            tickets.appendChild(buildTicket(ticket));
        });
        openTicket();
        return;
    }
    tickets.appendChild(buildTicket(data));
    openTicket();
}

async function openAgentFilter() {
    const main = document.getElementById("filters-div");

    if (main) {
        // retrieve agents from database
        const response = await fetch('../api/data.php?data=agents');
        const data = await response.json();

        // agentFilter div
        const agentFilter = document.createElement("div");
        agentFilter.id = "agent-filter";

        // agentFilter title
        const title = document.createElement("h4");
        title.textContent = "Filter by agent";
        agentFilter.appendChild(title);

        // agentFilter label
        const labelAgent = document.createElement("label");
        labelAgent.textContent = "Select agent:";
        agentFilter.appendChild(labelAgent);

        // agentFilter select
        const selectAgent = document.createElement("select");
        selectAgent.id = "agent-filter-input";
        data.forEach(agent => {
            const option = document.createElement("option");
            option.value = agent.username;
            option.textContent = agent.name;
            selectAgent.appendChild(option);
        });
        agentFilter.appendChild(selectAgent);

        // agentFilter button
        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveAgentFilterInput;
        agentFilter.appendChild(button);

        main.appendChild(agentFilter);
    }
}

async function retrieveStatusFilterInput() {
    const statusFilterInput = document.getElementById("status-filter-input").value;

    const response = await fetch('../api/filters.php?filter=status&status=' + statusFilterInput);
    const data = await response.json();

    const tickets = document.querySelector('.tickets-list ul');
    tickets.innerHTML = '';

    if(isArray(data)){
        data.forEach(ticket => {
            tickets.appendChild(buildTicket(ticket));
        });
        openTicket();
        return;
    }
    tickets.appendChild(buildTicket(data));
    openTicket();
}

async function openStatusFilter() {
    const main = document.getElementById("filters-div");

    if (main) {
        // retrieve status from database
        const response = await fetch('../api/data.php?data=statuses');
        const data = await response.json();

        // statusFilter div
        const statusFilter = document.createElement("div");
        statusFilter.id = "status-filter";

        // statusFilter title
        const title = document.createElement("h4");
        title.textContent = "Filter by status";
        statusFilter.appendChild(title);

        // statusFilter label
        const labelStatus = document.createElement("label");
        labelStatus.textContent = "Select status:";
        statusFilter.appendChild(labelStatus);

        // statusFilter select
        const selectStatus = document.createElement("select");
        selectStatus.id = "status-filter-input";
        data.forEach(status => {
            const option = document.createElement("option");
            option.value = status.id;
            option.textContent = status.name;
            selectStatus.appendChild(option);
        });
        statusFilter.appendChild(selectStatus);

        // statusFilter button
        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveStatusFilterInput;
        statusFilter.appendChild(button);

        main.appendChild(statusFilter);
    }
}

async function retrieveHashtagFilterInput() {
    const hashtagFilterInput = document.getElementById("hashtag-filter-input").value;

    const response = await fetch('../api/filters.php?filter=hashtag&hashtag=' + hashtagFilterInput);
    const data = await response.json();

    const tickets = document.querySelector('.tickets-list ul');
    tickets.innerHTML = '';

    if(isArray(data)){
        data.forEach(ticket => {
            tickets.appendChild(buildTicket(ticket));
        });
        openTicket();
        return;
    }
    tickets.appendChild(buildTicket(data));
    openTicket();
}

async function openHashtagFilter() {
    const main = document.getElementById("filters-div");

    if (main) {
        // retrieve hashtags from database
        const response = await fetch('../api/data.php?data=hashtags');
        const data = await response.json();

        // hashtagFilter div
        const hashtagFilter = document.createElement("div");
        hashtagFilter.id = "hashtag-filter";

        // statusFilter title
        const title = document.createElement("h4");
        title.textContent = "Filter by hashtag";
        hashtagFilter.appendChild(title);

        // statusFilter label
        const labelHashtag = document.createElement("label");
        labelHashtag.textContent = "Select hashtag:";
        hashtagFilter.appendChild(labelHashtag);

        // statusFilter select
        const selectHashtag = document.createElement("select");
        selectHashtag.id = "hashtag-filter-input";
        data.forEach(hashtag => {
            const option = document.createElement("option");
            option.value = hashtag.id;
            option.textContent = hashtag.name;
            selectHashtag.appendChild(option);
        });
        hashtagFilter.appendChild(selectHashtag);

        // statusFilter button
        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveHashtagFilterInput;
        hashtagFilter.appendChild(button);

        main.appendChild(hashtagFilter);
    }
}

searchTickets();
filterTicketsByDepartments();
buttonOpenFilters();
filtersClose();
