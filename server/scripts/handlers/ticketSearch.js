async function getFilteredTickets(data) {
    return fetch('../api/filterTickets.api.php', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax(data)
    });
}

function ticketSearcher(){
    const filterTab = document.getElementById("filter-tab");

    if (filterTab != null) {

        const searchButton = document.getElementById("search-button");
        searchButton.addEventListener("click", async function () {

            const _userId = filterTab.dataset.userid;
      
            const ownershipFilter = document.getElementById('ownership-filter');
            const _ownership = ownershipFilter != null ? ownershipFilter.value : 'All';
            const _status = document.getElementById('status-filter').value;
            const _priority = document.getElementById('priority-filter').value;
            const departmentFilter = document.getElementById('department-filter');
            const _department = departmentFilter != null ? departmentFilter.value : 'All';
            const _tags = tags.join(",");

            const section = document.querySelector('#tickets');
            section.innerHTML = '';
            const loading = document.createElement('i');
            loading.id = 'loader';
            loading.classList.add('fa-solid');
            loading.classList.add('fa-spinner');
            loading.classList.add('fa-spin');
            section.appendChild(loading);

            const response = await getFilteredTickets({
                userId: _userId,
                ownership: _ownership,
                status: _status,
                priority: _priority,
                department: _department,
                tags: _tags
            });
            const result = await response.json();

            if (result == null) {
                alert("Error fetching tickets");
                return;
            }

            const tickets = result["tickets"];
            const statuses = result["statuses"];
            const priorities = result["priorities"];

            for (let ticket of tickets) {
                ticket.status = statuses[ticket.status];
                ticket.priority = priorities[ticket.priority];
            }

            drawTickets(tickets);

            dropDown();
            adminDialog();
        });

        function drawTickets(tickets) {
            const section = document.querySelector('#tickets');
            section.innerHTML = '';
            for (const ticket of tickets) {

                const ticketContainer = document.createElement("div");
                ticketContainer.classList.add("edit-container");
                ticketContainer.classList.add("ticket-container");

                const dropdownButton = document.createElement("button");
                dropdownButton.type = "button";
                dropdownButton.classList.add("dropdown-button");

                const dropdownIcon = document.createElement("i");
                dropdownIcon.classList.add("fa-solid");
                dropdownIcon.classList.add("fa-ellipsis-vertical");

                dropdownButton.appendChild(dropdownIcon);

                const ticketDropdown = document.createElement("div");
                ticketDropdown.classList.add("ticket-dropdown");
                ticketDropdown.classList.add("edit-dropdown");

                const editOption = document.createElement("a");
                editOption.classList.add("dropdown-option");
                editOption.href = "../pages/editTicket.php?ticket=" + ticket.id;
                editOption.textContent = "Edit";

                const historyOption = document.createElement("a");
                historyOption.classList.add("dropdown-option");
                historyOption.href = "../pages/history.php?ticket=" + ticket.id;
                historyOption.textContent = "History";

                const removeOption = document.createElement("button");
                removeOption.classList.add("dropdown-option");
                removeOption.classList.add("remove-ticket");
                removeOption.textContent = "Delete";

                ticketDropdown.appendChild(editOption);
                ticketDropdown.appendChild(historyOption);  
                ticketDropdown.appendChild(removeOption);

                ticketContainer.appendChild(dropdownButton);
                ticketContainer.appendChild(ticketDropdown);

                const ticketCard = document.createElement("article");
                ticketCard.classList.add("edit-card");
                ticketCard.classList.add("ticket-card");
                ticketCard.classList.add("dash");

                const ticketTitle = document.createElement("h3");
                const ticketTitleLink = document.createElement("a");
                ticketTitleLink.classList.add("ticket-title");
                ticketTitleLink.href = "ticket.php?ticket=" + ticket.id;
                ticketTitleLink.textContent = ticket.subject;
                ticketTitle.appendChild(ticketTitleLink);
                                
                const statusTag = document.createElement("span");
                statusTag.classList.add("status-tag");
                statusTag.textContent = ticket.status;
                                
                const priorityTag = document.createElement("span");
                priorityTag.classList.add("priority-tag");
                priorityTag.textContent = ticket.priority;
                                
                const statusParagraph = document.createElement("p");
                statusParagraph.textContent = "Status:";
                statusParagraph.appendChild(statusTag);
                                
                const priorityParagraph = document.createElement("p");
                priorityParagraph.textContent = "Priority:";
                priorityParagraph.appendChild(priorityTag);

                const descriptionParagraph = document.createElement("p");
                descriptionParagraph.textContent = ticket.description;
                                
                const tagsList = document.createElement("ul");
                tagsList.classList.add("tags");
                                
                for (const tag of ticket.tags) {

                    const tagItem = document.createElement("li");
                    tagItem.classList.add("tag");
                    tagItem.textContent = tag;
                    tagsList.appendChild(tagItem);
                }

                ticketCard.appendChild(ticketTitle);
                ticketCard.appendChild(statusParagraph);
                ticketCard.appendChild(priorityParagraph);
                ticketCard.appendChild(descriptionParagraph);
                ticketCard.appendChild(tagsList);

                const removeDialog = document.createElement("dialog");
                removeDialog.classList.add("remove-dialog");

                const removeForm = document.createElement("form");
                removeForm.action = "../actions/removeTicket.action.php";
                removeForm.method = "post";

                const removeId = document.createElement("input");
                removeId.type = "hidden";
                removeId.name = "id";
                removeId.value = ticket.id;

                const removeParagraph = document.createElement("p");
                removeParagraph.textContent = "Are you sure you want to remove this ticket?";

                const dialogButtons = document.createElement("div");
                dialogButtons.classList.add("dialog-buttons");

                const cancelButton = document.createElement("button");
                cancelButton.type = "button";
                cancelButton.classList.add("button");
                cancelButton.classList.add("cancel-button");
                cancelButton.value = "Cancel";
                cancelButton.textContent = "Cancel";

                const removeButton = document.createElement("button");
                removeButton.type = "submit";
                removeButton.classList.add("button");
                removeButton.textContent = "Remove";

                dialogButtons.appendChild(cancelButton);
                dialogButtons.appendChild(removeButton);

                removeForm.appendChild(removeId);
                removeForm.appendChild(removeParagraph);
                removeForm.appendChild(dialogButtons);

                removeDialog.appendChild(removeForm);

                ticketContainer.appendChild(ticketCard);
                ticketContainer.appendChild(removeDialog);

                section.appendChild(ticketContainer);

                const removeTicket = document.querySelector(".remove-ticket");
                const removeDialogs = document.querySelectorAll(".remove-dialog");
                const cancelButtons = document.querySelectorAll(".cancel-button");

                for (const cancelButton of cancelButtons) {
                    cancelButton.addEventListener("click", function() {
                        cancelButton.parentElement.parentElement.close();
                    });
                }

                if (removeTicket != null) {
                    removeTicket.addEventListener("click", function() {
                        removeTicket.parentElement.parentElement.querySelector(".remove-dialog").showModal();
                    });    
                }        
            }
        }
    }
};