export function openTicket() {
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

openTicket();
addHashtag();