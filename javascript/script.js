function openTicket() {
    const tickets = document.querySelectorAll('.ticket');

    if (tickets) {
        tickets.forEach(ticket => {
            ticket.addEventListener('click', () => {
                window.location.href = 'ticket.php?id=' + ticket.querySelector('li:first-child p').textContent.substring(1);
            });
        });
    }
}

// To add a new hashtah, the agent/admin must press the # key
function addHashtag() {
    document.addEventListener('keydown', function (event) {
        const location = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        if (event.key === '#' && location === 'ticket.php?id=' + document.querySelector('.ticket-id-title h1:first-child').textContent.substring(1)) {
            alert('You pressed the # key'); //TODO add the hashtag
        }
    });
}

function searchTickets() {
    const search = document.querySelector('.search-ticket');

    if (search) {
        search.addEventListener('input', async () => {
            const response = await fetch('../api/search_tickets.php?search=' + search.value);
            const data = await response.json();

            const tickets = document.querySelector('.tickets-list ul');
            tickets.innerHTML = '';

            data.forEach(ticket => {
                // li wraper for ticket
                const ticketElement = document.createElement('li');
                ticketElement.classList.add('ticket');

                // ul wraper for ticket elements
                const ticketElementList = document.createElement('ul');

                // ticket id
                const ticketElementListId = document.createElement('li');
                const ticketId = document.createElement('p');
                ticketId.textContent = '#' + ticket.id;
                ticketElementListId.appendChild(ticketId);

                // ticket title
                const ticketElementListTitle = document.createElement('li');
                const ticketTitle = document.createElement('p');
                ticketTitle.textContent = ticket.title;
                ticketElementListTitle.appendChild(ticketTitle);

                // ticket date
                const ticketElementListDate = document.createElement('li');
                const ticketDate = document.createElement('p');
                ticketDate.textContent = ticket.date;
                ticketElementListDate.appendChild(ticketDate);

                // ticket status
                const ticketElementListStatus = document.createElement('li');
                const ticketStatus = document.createElement('p');
                ticketStatus.textContent = ticket.status;
                ticketElementListStatus.appendChild(ticketStatus);

                ticketElementList.appendChild(ticketElementListId);
                ticketElementList.appendChild(ticketElementListTitle);
                ticketElementList.appendChild(ticketElementListDate);
                ticketElementList.appendChild(ticketElementListStatus);

                ticketElement.appendChild(ticketElementList);

                tickets.appendChild(ticketElement);
            });
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
                console.log(data);
                data.forEach(ticket => {
                    // li wraper for ticket
                    const ticketElement = document.createElement('li');
                    ticketElement.classList.add('ticket');

                    // ul wraper for ticket elements
                    const ticketElementList = document.createElement('ul');

                    // ticket id
                    const ticketElementListId = document.createElement('li');
                    const ticketId = document.createElement('p');
                    ticketId.textContent = '#' + ticket.id;
                    ticketElementListId.appendChild(ticketId);

                    // ticket title
                    const ticketElementListTitle = document.createElement('li');
                    const ticketTitle = document.createElement('p');
                    ticketTitle.textContent = ticket.title;
                    ticketElementListTitle.appendChild(ticketTitle);

                    // ticket date
                    const ticketElementListDate = document.createElement('li');
                    const ticketDate = document.createElement('p');
                    ticketDate.textContent = ticket.date;
                    ticketElementListDate.appendChild(ticketDate);

                    // ticket status
                    const ticketElementListStatus = document.createElement('li');
                    const ticketStatus = document.createElement('p');
                    ticketStatus.textContent = ticket.status;
                    ticketElementListStatus.appendChild(ticketStatus);

                    ticketElementList.appendChild(ticketElementListId);
                    ticketElementList.appendChild(ticketElementListTitle);
                    ticketElementList.appendChild(ticketElementListDate);
                    ticketElementList.appendChild(ticketElementListStatus);

                    ticketElement.appendChild(ticketElementList);

                    tickets.appendChild(ticketElement);
                });
            });
        });
    }
}

openTicket();
addHashtag();
searchTickets();
filterTicketsByDepartments();