import {buildTicket} from '../utilities/utilities.js';

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
                tickets.appendChild(buildTicket(ticket));
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
                
                data.forEach(ticket => {
                    tickets.appendChild(buildTicket(ticket));
                });
            });
        });
    }
}

function faqsDisplay() {
    const faqs = document.querySelectorAll(".faqs .faq");
    let openedFaq = null;

    faqs.forEach((faq) => {
        const question = faq.querySelector("h3");
        const answer = faq.querySelector("p");

        question.addEventListener("click", () => {
            if (openedFaq && openedFaq !== faq) {
                openedFaq.classList.remove("open");
                openedFaq.querySelector("p").classList.remove("show");
            }

            faq.classList.toggle("open");
            answer.classList.toggle("show");

            if (faq.classList.contains("open")) {
                openedFaq = faq;
            } else {
                openedFaq = null;
            }
        });
    });
}


openTicket();
addHashtag();
searchTickets();
filterTicketsByDepartments();
faqsDisplay();