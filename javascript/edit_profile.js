function closeOpenAddRemoveDepartments(){
    const manageDepartments = document.getElementById("manage-departments");
    const departmentsList = document.querySelector("#manage-departments ul");
    const selectedDepartment = document.querySelector("#manage-departments select option:checked");
    var departmentsLabel = document.getElementById("departments-label");

    if(departmentsLabel) {
        departmentsLabel.innerHTML = '';
        departmentsLabel.textContent = 'departments';

        if(selectedDepartment) {
            //create selected department
            const selectedDepartmentButton = document.createElement("li");
            const selectedDepartmentButtonText = document.createElement("p");
            selectedDepartmentButtonText.textContent = selectedDepartment.textContent;
            selectedDepartmentButton.appendChild(selectedDepartmentButtonText);
            departmentsList.appendChild(selectedDepartmentButton);
        }

        //create add/remove departments button
        const addRemoveDepartmentsButton = document.createElement("li");
        const addRemoveDepartmentsButtonText = document.createElement("p");
        addRemoveDepartmentsButtonText.id = "add-remove-user-department";
        addRemoveDepartmentsButtonText.textContent = "Add/Remove department";
        addRemoveDepartmentsButton.appendChild(addRemoveDepartmentsButtonText);
        departmentsList.appendChild(addRemoveDepartmentsButton);

        departmentsList.id = "new_departments";
        departmentsLabel.appendChild(departmentsList);
        const br = document.createElement("br");
        departmentsLabel.appendChild(br);
        departmentsLabel.appendChild(br);
    }

    if(manageDepartments) {
        manageDepartments.remove();
    }
    openAddRemoveDepartments();
}

function openAddRemoveDepartments() {
    const addRemoveDepartmentsButton = document.getElementById("add-remove-user-department");
    
    if(addRemoveDepartmentsButton) {
        addRemoveDepartmentsButton.addEventListener("click", async function() {
            const response = await fetch('../api/data.php?data=departments');
            const data = await response.json();

            const main = document.getElementById("departments-label");
            var departments = Array.from(document.querySelectorAll("#new_departments li p"));
            departments.pop();

            const manageDepartments = document.createElement("div");
            manageDepartments.id = "manage-departments";

            // departments title
            const title = document.createElement("h4");
            title.textContent = "Manage Departments";
            manageDepartments.appendChild(title);

            // departments list
            const manageDepartmentsList = document.createElement("ul");

            for(const department in departments){
                const departmentListItem = document.createElement("li");
                const departmentText = document.createElement("p");
                departmentText.textContent = departments[department].textContent;
                departmentListItem.appendChild(departmentText);
                manageDepartmentsList.appendChild(departmentListItem);
            }
            manageDepartments.appendChild(manageDepartmentsList);

            // add department
            const addDepartmentInput = document.createElement("select");
            addDepartmentInput.name = "add-department-input";
            var added = [];
            departments.forEach(function(department){
                added.push(department.textContent);
            });
            data.forEach(function(department){
                if(!added.includes(department.name)) {
                    const option = document.createElement("option");
                    option.value = department.id;
                    option.textContent = department.name;
                    addDepartmentInput.appendChild(option);
                    added.push(department.name);
                }
            });

            manageDepartments.appendChild(addDepartmentInput);

            const button = document.createElement("button");
            button.type = "button";
            button.textContent = "Done";
            button.onclick = closeOpenAddRemoveDepartments;
            manageDepartments.appendChild(button);

            main.appendChild(manageDepartments);
            deleteDepartment();
        });
    }
}

function deleteDepartment(){
    const departments = document.querySelectorAll("#manage-departments ul li");

    if(departments){
        departments.forEach(function(department){
            department.addEventListener("click", function(){
                department.remove();
            });
        });
    }
}

function submitEditProfileForm() {
    const button = document.getElementById("done-button-edit-profile");
   
    if(button) {
        button.addEventListener("click", function() {
            var departments = Array.from(document.querySelectorAll("#new_departments li p"));
            var form = document.getElementById("edit-profile-form");

            departments.forEach(function(department) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "departments[]";
                input.value = department.textContent;
                form.appendChild(input);
            });

            form.submit();
        });
    }
}

openAddRemoveDepartments();
submitEditProfileForm();