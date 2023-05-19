export function buildTicket(ticket){
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

    return ticketElement;
}