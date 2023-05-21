export function openTicket() {
    const tickets = document.querySelectorAll('.ticket');

    if (tickets && !window.location.href.includes('tickets.php')) {
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

openTicket();
addHashtag();
closeAddHashtag();