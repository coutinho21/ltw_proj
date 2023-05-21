function closeOptions() {
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("faq-options")) {
            return;
        }
        const options = document.querySelectorAll(".options-div");

        options.forEach((option) => {
            option.remove();
        });
    });
}

function faqsDisplay() {
    const faqs = document.querySelectorAll(".faqs .faq");
    let openedFaq = null;

    faqs.forEach((faq) => {
        const answer = faq.querySelector("p:last-child");
        const options = faq.querySelector(".faq-options");

        faq.addEventListener("click", (event) => {
            if (event.target === options) {
                return;
            }
            if (openedFaq && openedFaq !== faq) {
                openedFaq.classList.remove("open");
                openedFaq.querySelector("p:last-child").classList.remove("show");
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

function newFAQ() {
    const newFaqButton = document.getElementById("new-faq-button");

    if (newFaqButton) {
        newFaqButton.addEventListener("click", (e) => {
            const alreadyOpen = document.querySelector("#new-faq");
            if (!alreadyOpen) {
                const main = document.querySelector(".faqs");

                // new faq form
                const newFaqForm = document.createElement("form");
                newFaqForm.id = "new-faq";
                newFaqForm.method = "post";
                newFaqForm.action = "../actions/action_new_faq.php";
                newFaqForm.style.top = (parseInt(e.clientY) + parseInt(window.scrollY)).toString() + "px";
                newFaqForm.style.left = (parseInt(e.clientX) + parseInt(window.scrollX) - 100).toString() + "px";

                // new faq content div
                const faqContentDiv = document.createElement("div");
                faqContentDiv.classList.add("faq-content");

                // new faq csrf input
                const csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "csrf";
                csrf.value = document.getElementById("csrf").textContent;
                faqContentDiv.appendChild(csrf);

                // new faq question and answer inputs
                const faqQuestionInput = document.createElement("input");
                faqQuestionInput.type = "text";
                faqQuestionInput.placeholder = "Question";
                faqQuestionInput.required = true;
                faqQuestionInput.name = "question";
                const faqAnswerInput = document.createElement("textarea");
                faqAnswerInput.placeholder = "Answer";
                faqAnswerInput.required = true;
                faqAnswerInput.name = "answer";
                faqContentDiv.appendChild(faqQuestionInput);
                faqContentDiv.appendChild(faqAnswerInput);

                // new faq buttons div
                const faqButtonsDiv = document.createElement("div");
                faqButtonsDiv.classList.add("faq-buttons");

                // new faq cancel and save buttons
                const faqCancelButton = document.createElement("button");
                faqCancelButton.type = "button";
                faqCancelButton.textContent = "Cancel";
                faqCancelButton.addEventListener("click", () => {
                    newFaqForm.remove();
                });
                const faqSaveButton = document.createElement("button");
                faqSaveButton.type = "submit";
                faqSaveButton.textContent = "Save";
                faqButtonsDiv.appendChild(faqCancelButton);
                faqButtonsDiv.appendChild(faqSaveButton);

                newFaqForm.appendChild(faqContentDiv);
                newFaqForm.appendChild(faqButtonsDiv);

                main.appendChild(newFaqForm);
            }
        });
    }
}

function openOptions() {
    const options = document.querySelectorAll(".faq-options");

    if (options) {
        options.forEach((option) => {
            option.addEventListener("click", (e) => {
                const alreadyOpen = document.querySelector(".options-div");
                if (!alreadyOpen) {
                    const main = option.parentNode;

                    const optionsDiv = document.createElement("div");
                    optionsDiv.classList.add("options-div");
                    optionsDiv.style.top = (parseInt(e.clientY) + parseInt(window.scrollY)).toString() + "px";
                    optionsDiv.style.left = (parseInt(e.clientX) + parseInt(window.scrollX) - 100).toString() + "px";

                    const editButton = document.createElement("button");
                    editButton.type = "button";
                    editButton.textContent = "Edit";
                    editButton.addEventListener("click", (e) => {
                        // edit faq form
                        const editFaqForm = document.createElement("form");
                        editFaqForm.classList.add("edit-faq");
                        editFaqForm.method = "post";
                        editFaqForm.action = "../actions/action_edit_faq.php";
                        editFaqForm.style.top = (parseInt(e.clientY) + parseInt(window.scrollY)).toString() + "px";
                        editFaqForm.style.left = (parseInt(e.clientX) + parseInt(window.scrollX) - 100).toString() + "px";

                        // edit faq content div
                        const faqContentDiv = document.createElement("div");
                        faqContentDiv.classList.add("faq-content");

                        // edit faq csrf input
                        const csrf = document.createElement("input");
                        csrf.type = "hidden";
                        csrf.name = "csrf";
                        csrf.value = document.getElementById("csrf").textContent;
                        faqContentDiv.appendChild(csrf);

                        // edit faq id input
                        const faqIdInput = document.createElement("input");
                        faqIdInput.classList.add("edit-faq-id");
                        faqIdInput.value = option.parentNode.parentNode.querySelector(".faq-id").textContent;
                        faqIdInput.type = "hidden";
                        faqIdInput.name = "id";
                        faqContentDiv.appendChild(faqIdInput);

                        // edit faq question and answer inputs
                        const faqQuestionInput = document.createElement("input");
                        faqQuestionInput.type = "text";
                        faqQuestionInput.placeholder = "Question";
                        faqQuestionInput.required = true;
                        faqQuestionInput.name = "question";
                        faqQuestionInput.value = option.parentNode.parentNode.querySelector(".faq-question").textContent;
                        const faqAnswerInput = document.createElement("textarea");
                        faqAnswerInput.placeholder = "Answer";
                        faqAnswerInput.required = true;
                        faqAnswerInput.name = "answer";
                        faqAnswerInput.value = option.parentNode.parentNode.querySelector(".faq-answer").textContent;
                        faqContentDiv.appendChild(faqQuestionInput);
                        faqContentDiv.appendChild(faqAnswerInput);

                        // edit faq buttons div
                        const faqButtonsDiv = document.createElement("div");
                        faqButtonsDiv.classList.add("edit-faq-buttons");

                        // edit faq cancel and save buttons
                        const faqCancelButton = document.createElement("button");
                        faqCancelButton.type = "button";
                        faqCancelButton.textContent = "Cancel";
                        faqCancelButton.addEventListener("click", () => {
                            editFaqForm.remove();
                        });
                        const faqSaveButton = document.createElement("button");
                        faqSaveButton.type = "submit";
                        faqSaveButton.textContent = "Save";
                        faqButtonsDiv.appendChild(faqCancelButton);
                        faqButtonsDiv.appendChild(faqSaveButton);

                        editFaqForm.appendChild(faqContentDiv);
                        editFaqForm.appendChild(faqButtonsDiv);

                        document.querySelector(".faqs").appendChild(editFaqForm);
                    });

                    const deleteButton = document.createElement("button");
                    deleteButton.type = "button";
                    deleteButton.textContent = "Delete";
                    deleteButton.addEventListener("click", () => {
                        deleteFAQ(option.parentNode.parentNode.querySelector(".faq-id").textContent);
                    });

                    optionsDiv.appendChild(editButton);
                    optionsDiv.appendChild(deleteButton);

                    main.appendChild(optionsDiv);
                }
            });
        });
    }
}

function deleteFAQ(id) {
    window.location.href = "../actions/action_delete_faq.php?id=" + id;
}

faqsDisplay();
newFAQ();
openOptions();
closeOptions();