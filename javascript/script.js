const tickets = document.querySelectorAll('.ticket');

tickets.forEach(ticket => {
    ticket.addEventListener('click', () => {
        window.location.href = 'ticket.php?id=' + ticket.querySelector('li:first-child p').textContent.substring(1);
    });
});
