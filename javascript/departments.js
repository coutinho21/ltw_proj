function closeNewDepartment() {
    document.addEventListener("click", (e) => {
        const newDepartment = document.getElementById("new-department");
        const exception = document.getElementById("add-new-department");

        if (newDepartment && !exception.contains(e.target)) {
            if (newDepartment.contains(e.target)) {
                return;
            }
            newDepartment.remove();
        }
    });
}

function openNewDepartment() {
    const newDepartment = document.getElementById("add-new-department");

    if (newDepartment) {
        newDepartment.addEventListener("click", (e) => {
            const alreadyOpen = document.getElementById("new-department");
            if (!alreadyOpen) {
                const main = document.querySelector(".departments");

                // new department form
                const newDepartmentForm = document.createElement("form");
                newDepartmentForm.id = "new-department";
                newDepartmentForm.method = "post";
                newDepartmentForm.action = "../actions/action_new_department.php";
                newDepartmentForm.style.top = (parseInt(e.clientY) + parseInt(window.scrollY)).toString() + "px";
                newDepartmentForm.style.left = (parseInt(e.clientX) + parseInt(window.scrollX) - 100).toString() + "px";

                // new department csrf input
                const csrf = document.createElement("input");
                csrf.type = "hidden";
                csrf.name = "csrf";
                csrf.value = document.getElementById("csrf").textContent;
                newDepartmentForm.appendChild(csrf);

                // new department title
                const departmentTitle = document.createElement("h4");
                departmentTitle.innerText = "New Department";

                // new department name input
                const departmentNameInput = document.createElement("input");
                departmentNameInput.type = "text";
                departmentNameInput.name = "department-name";
                departmentNameInput.id = "department-name";

                // new department submit button
                const departmentSubmitButton = document.createElement("button");
                departmentSubmitButton.type = "submit";
                departmentSubmitButton.name = "submit";
                departmentSubmitButton.innerText = "Submit";

                newDepartmentForm.appendChild(departmentTitle);
                newDepartmentForm.appendChild(departmentNameInput);
                newDepartmentForm.appendChild(departmentSubmitButton);

                main.appendChild(newDepartmentForm);
            }
        });
    }
}

openNewDepartment();
closeNewDepartment();