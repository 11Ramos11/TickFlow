async function ticketEditorHandler(){

    const editTicketForm = document.getElementById("edit-ticket")

    if (editTicketForm == null){
        return;
    }

    async function getDepartmentUsers(data) {
        return fetch('../api/departmentUsers.api.php', {
            method: 'post',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: encodeForAjax(data)
        });
    }

    const departmentSelector = document.getElementById('department');
    const assigneeSelector = document.getElementById('assignee');

    departmentSelector.addEventListener('change', async (event) => {
        const departmentID = event.target.value;

        const response = await getDepartmentUsers({
            department: departmentID
        });

        const users = await response.json();

        const userRole = editTicketForm.dataset.role;
        const userDepartment = editTicketForm.dataset.department;
        const assigneeID = editTicketForm.dataset.assigneeid;

        assigneeSelector.innerHTML = '';

        const option = document.createElement('option');
        option.value = '-1';
        option.innerText = 'To be assigned';
        assigneeSelector.appendChild(option);

        const hasPerms = userRole == 'Admin' || userDepartment == departmentID;

        users.forEach(user => {

            console.log(user + ' | ' + assigneeID);
            console.log();
            if (hasPerms){ 
                const option = document.createElement('option');
                option.value = user.id;
                option.innerText = user.name;
                assigneeSelector.appendChild(option);
            } else if (user.id == assigneeID) {
                const option = document.createElement('option');
                option.value = user.id;
                option.innerText = `${user.name} (current)`;
                assigneeSelector.appendChild(option);
            }
        });
    });
}