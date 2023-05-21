/* Tags */

let tags = [];


function remove(element, tag){
    tags = tags.filter(t => t != tag);
    element.parentElement.remove();
}

window.onload = function () {
    
    responsiveness();
    createTags();
    filterTickets();
    editProfile();
    showSnackBar();
    messagesHandler();
    adminDialog();

    dropDown();

    editTicket();
};

async function editTicket(){

    const editTicketForm = document.getElementById("edit-ticket")

    if (editTicketForm == null){
        return;
    }

    async function getDepartmentUsers(data) {
        return fetch('../api/departmentUser.api.php', {
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


async function responsiveness(){

    const leftSidebar = document.querySelector(".left-sidebar");
    const middleColumn = document.querySelector(".middle-column");
    const rightSidebar = document.querySelector(".right-sidebar");


    const optionsButtonRight = document.querySelector(".options-right");
    const optionsButtonLeft = document.querySelector(".options-left");

    optionsButtonRight.addEventListener("click", () => {
		middleColumn.classList.toggle("middle-column-active");
		rightSidebar.classList.toggle("right-sidebar-active");
        optionsButtonRight.classList.toggle("options-right-active");
    });

    optionsButtonLeft.addEventListener("click", () => {
        leftSidebar.classList.toggle("left-sidebar-active");
        middleColumn.classList.toggle("middle-column-active");
    });

}

async function createTags() {

    const tagsList = document.getElementById("tag-creator");
    const input = document.getElementById("tag-input");

    if (tagsList == null || input == null){
        return;
    }

    readTags();

    function readTags(){
        const tagsInput = document.getElementById("tags");
        if (tagsInput != null){
            tagsValue = tagsInput.value;
            if (tagsValue.trim() == ""){
                return;
            }
            tags = tagsValue.split(",");
            addListItem();
        }
    }

    function addListItem() {
        tagsList.querySelectorAll("li").forEach(li => li.remove());
        tags.forEach(tag => {
            let li = `<li class="tag">${tag}<button type="button" onclick="remove(this, '${tag}')">x</button></li>`;
            input.insertAdjacentHTML('beforebegin', li);
        });
    }

    function addTag(e) {

        if (e.code == "Space" || e.code == "Enter") {
            let tag = e.target.value.replace(/\s+/g, ' ');
            tag = tag.trim();

            if (tag.length > 1 && !tags.includes(tag)) {
                tags.push(tag);
            }
            addListItem();
            e.target.value = "";
        }
    }

    tagsList.addEventListener("keydown", addTag);

    const submitButton = document.getElementById("submit-button");

    if (submitButton != null){
        submitButton.addEventListener("click", () => {
            let tagsInput = document.getElementById("tags");
            tagsInput.value = tags;
        });
    }

    const autoCompleteUL = document.getElementById("auto-complete");

    if (autoCompleteUL != null) {

        async function getTags() {
            return fetch('../api/autoCompleteTags.api.php', {
                method: 'post',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                }
            });
        }

        const tag_input = document.getElementById("tag-input");
        
        const response = await getTags();

        const allTags = await response.json();

        if (allTags == null) {
            alert("Error fetching tags");
            return;
        }

        async function showAutoComplete(){
            let input = tag_input.value;
            input = input.trim();

            let filteredTags = allTags.filter(tag => tag.toLowerCase().startsWith(input.toLowerCase()));
                
            autoCompleteUL.innerHTML = "";

            for (const tag of filteredTags) {
                const li = document.createElement("li");
                li.classList.add("auto-complete-tag");
                const bold = document.createElement("b");
                bold.textContent = input;
      
                li.appendChild(bold);
                const remaining = document.createElement("span");
                remaining.textContent = tag.substring(input.length);

                li.appendChild(remaining);
                li.addEventListener("click", function() {
                    tags.push(tag);
                    autoCompleteUL.innerHTML = "";
                    tag_input.value = "";
                    addListItem();
                    tag_input.focus();
                });
                autoCompleteUL.appendChild(li);
            }
        };

        tag_input.addEventListener("keyup", async function() {
            await showAutoComplete();
        });

        tag_input.addEventListener("click", async function() {
            await showAutoComplete();
        });

        tag_input.addEventListener("focus", async function() {
            await showAutoComplete();
        });

        document.addEventListener("click", function(e) {
            if (!tag_input.contains(e.target)) {
                autoCompleteUL.innerHTML = "";
            }
        });

        document.addEventListener("keyup", function(e) {

            if (e.code == "Escape") {
                autoCompleteUL.innerHTML = "";
            }
        });
    }
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

async function getFilteredTickets(data) {
    return fetch('../api/filterTickets.api.php', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax(data)
    });
}

function filterTickets(){
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

function editProfile(){

    const profileInfo = document.getElementById("profile-info");

    if (profileInfo != null){

        const editButton = document.getElementById("edit-user-button");
        const editProfile = document.getElementById("edit-profile");
        const cancelButton = document.getElementById("cancel-button");

        function toggleProfile(){
            profileInfo.classList.toggle("active");
            editProfile.classList.toggle("active");
        }

        editButton.addEventListener("click", function() {

            const nameInfo = document.getElementById("name-info");
            const emailInfo = document.getElementById("email-info");
            const roleInfo = document.getElementById("role-info");
            const departmentInfo = document.getElementById("department-info");

            const nameEditor = document.getElementById("name-editor");
            nameEditor.value = nameInfo.textContent;

            const emailEditor = document.getElementById("email-editor");
            emailEditor.value = emailInfo.textContent;

            const roleSelector = document.getElementById("role-editor");
            if (roleSelector != null){
                const roleOption = document.getElementById(roleInfo.textContent);
                roleOption.setAttribute("selected",  "selected")
            }

            const departmentEditor = document.getElementById("department-editor");
            if (departmentEditor != null){
                const departmentOption = document.getElementById(departmentInfo.textContent);
                departmentOption.setAttribute("selected",  "selected")

            }

            toggleProfile();
        });

        cancelButton.addEventListener("click", function() {
            toggleProfile();
            disablePasswordField();
        });

        const passwordEditor = document.getElementById("password-editor");
        const showPassword = document.getElementById("change-password-button");

        if (showPassword != null){
            showPassword.addEventListener("click", function() {
                togglePasswordField();
            });
        }

        const cancelPassword = document.getElementById("cancel-password-button");

        if (cancelPassword != null){
            cancelPassword.addEventListener("click", function() {
                togglePasswordField();
            });
        }

        function disablePasswordField(){
            passwordEditor.classList.remove("active");
            if (!showPassword.classList.contains("active"))
                showPassword.classList.add("active");
        }

        function togglePasswordField(){
            passwordEditor.classList.toggle("active");
            showPassword.classList.toggle("active");
        }

    }
}

function showSnackBar() {
    // Get the snackbar DIV
   const snackbar = document.getElementsByClassName("snack-bar")[0];
  
   if (snackbar == null){
        return;
    }

    snackbar.classList.toggle("show");
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ snackbar.classList.toggle("show"); }, 4000);
  }

function messagesHandler(){

    const sendButton = document.getElementById("send-message-button");

    if (sendButton == null){
        return;
    }

    async function sendMessageRequest(data){
    
        return fetch("../api/messages.api.php", {
            method: "post",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: encodeForAjax(data)
        });
    }

    async function sendNewMessage() {
        const messageInput = document.getElementById("message-input");
        const message= messageInput.value;
        const ticketID = document.getElementById("ticket-id").textContent;
        const userID = document.getElementById("user-id").textContent;

        if (message.trim() == ""){
            return false;
        }

        messageInput.value = "";

        const response = await sendMessageRequest({
            userID: userID,
            ticketID: ticketID,
            message: message
        });

        const messages = await response.json();

        return messages;
    }

    function drawMessages(messages){

        const userID = document.getElementById("user-id").textContent;
        const ticketAuthorID = document.getElementById("ticket-author-id").textContent;

        if (messages.error != null){
            alert(result.error);
            return;
        }

        const messagesSection = document.getElementById("messages");
        messagesSection.innerHTML = "";

        messages = messages.reverse();

        for (const message of messages){
            const messageBox = document.createElement("article");
            messageBox.classList.add("msg");

            if (userID == ticketAuthorID){
                if (message.author == userID){
                    messageBox.classList.add("msg-right");
                    messageBox.classList.add("author");
                }
                else
                    messageBox.classList.add("msg-left");
            }
            else {
                if (message.author == ticketAuthorID){
                    messageBox.classList.add("msg-left");
                }
                else {
                    messageBox.classList.add("msg-right");
                    if (message.author == userID)
                        messageBox.classList.add("author");
                }
            }

            const figure = document.createElement("figure");
            figure.classList.add("avatar");
            const img = document.createElement("img");
            img.src = message.authorPhoto;
            img.alt = "Avatar";
            
            const bubble = document.createElement("section");
            bubble.classList.add("bubble");

            const author = document.createElement("p");
            author.classList.add("name");
            author.textContent = message.authorName;

            const content = document.createElement("p");
            content.classList.add("message");
            content.textContent = message.content;

            bubble.appendChild(author);
            bubble.appendChild(content);
            figure.appendChild(img);
            messageBox.appendChild(figure);
            messageBox.appendChild(bubble);
            messagesSection.appendChild(messageBox);
        }
    }

    async function sendingMessagesListener(){
        messages = await sendNewMessage();

        if (messages == false){
            return;
        }

        drawMessages(messages);
    }

    sendButton.addEventListener("click", async function () {
        sendingMessagesListener();
    });    
    document.addEventListener("keydown", async function (event) {
        if (event.key == "Enter"){
            sendingMessagesListener();
        }
    });

    async function getMessages() {
        const ticketID = document.getElementById("ticket-id").textContent;
        const userID = document.getElementById("user-id").textContent;

        const response = await sendMessageRequest({
            userID: userID,
            ticketID: ticketID
        });

        const messages = await response.json();

        return messages;
    }

    async function updateMessages() {
        const messages = await getMessages();

        drawMessages(messages);
    }
}

function adminDialog(){


    const removeTicketButtons = document.getElementsByClassName("remove-ticket");

    if (removeTicketButtons.length != 0){
        for (const removeButton of removeTicketButtons){
            removeButton.addEventListener("click", function() {
                removeDialog = removeButton.parentElement.parentElement.getElementsByClassName("remove-dialog")[0];
    
                removeDialog.getElementsByClassName("cancel-button")[0].addEventListener("click", function() {
                    removeDialog.close();
                });
                removeDialog.showModal();
            });
        }
    }

    const removeFAQButtons = document.getElementsByClassName("remove-faq");

    if (removeFAQButtons.length != 0){
        for (const removeButton of removeFAQButtons){
            removeButton.addEventListener("click", function() {
                removeDialog = removeButton.parentElement.parentElement.getElementsByClassName("remove-dialog")[0];
             
                removeDialog.getElementsByClassName("cancel-button")[0].addEventListener("click", function() {
                    removeDialog.close();
                });
                removeDialog.showModal();
            });
        }
    }
    
    if (document.getElementById("administration") == null){
        return;
    }

    const categories = document.getElementsByClassName("category");

    for (const category of categories){
        
        const addButton = category.getElementsByClassName("add-button")[0];
        const addDialog = category.getElementsByClassName("add-dialog")[0];
        
        addButton.addEventListener("click", function() {
            addDialog.showModal();
        });

        const cancelButton = addDialog.getElementsByClassName("cancel-button")[0];
        cancelButton.addEventListener("click", function() {
            addDialog.close();
        });
    }

    const adminItems = document.getElementsByClassName("admin-item");

    for (const adminItem of adminItems){
            
        const editButton = adminItem.getElementsByClassName("edit-button")[0];
        const editDialog = adminItem.getElementsByClassName("edit-dialog")[0];
        
        editButton.addEventListener("click", function() {
            editDialog.showModal();
        });
        
        const removeButton = adminItem.getElementsByClassName("remove-button")[0];
        const removeDialog = adminItem.getElementsByClassName("remove-dialog")[0];

        removeButton.addEventListener("click", function() {
            removeDialog.showModal();
        });

        const editCancelButton = editDialog.getElementsByClassName("cancel-button")[0];
        editCancelButton.addEventListener("click", function() {
            editDialog.close();
        }); 

        const removeCancelButton = removeDialog.getElementsByClassName("cancel-button")[0];
        removeCancelButton.addEventListener("click", function() {
            removeDialog.close();
        });

    }
}

function dropDown(){

    const dropdownContainers = document.getElementsByClassName("edit-container");

    if (dropdownContainers.length == 0){
        return;
    }

    for (const dropdownContainer of dropdownContainers){

        const dropdownButton = dropdownContainer.getElementsByClassName("dropdown-button")[0];

        dropdownButton.addEventListener("click", function() {
            dropdownContainer.getElementsByClassName("edit-dropdown")[0].classList.toggle("active");
        });

        dropdownButton.parentElement.addEventListener("mouseleave", function() {
            dropdownContainer.getElementsByClassName("edit-dropdown")[0].classList.remove("active");
        });
    } 
}