/* Tags */

let tags = [];


function remove(element, tag){
    tags = tags.filter(t => t != tag);
    element.parentElement.remove();
}

window.onload = function () {
    createTags();
    filterTickets();
    userDropdown();
    editProfile();
    showError();
    messagesHandler();
    adminDialog();
    ticketDropdown();
};

function createTags() {

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
            console.log(tags);
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

    const filterTab = document.getElementById("filter-tab");

    if (filterTab != null) {

        async function getTags(data) {
            return fetch('../api/autoCompleteTags.api.php', {
                method: 'post',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: encodeForAjax(data)
            });
        }

        const tag_input = document.getElementById("tag-input");

        async function showAutoComplete(){
            const _userId = filterTab.dataset.userid;
            let input = tag_input.value;

            input = input.trim();

            const response = await getTags({
                userId: _userId,
                input: input
            });

            const tagsResponse = await response.json();

            if (tagsResponse == null) {
                alert("Error fetching tags");
                return;
            }

            const autoCompleteUL = document.getElementById("auto-complete");

            autoCompleteUL.innerHTML = "";

            for (const tag of tagsResponse) {
                const li = document.createElement("li");
                li.classList.add("auto-complete-tag");
                li.textContent = tag;
                li.addEventListener("click", function() {
                    tags.push(tag);
                    autoCompleteUL.innerHTML = "";
                    tag_input.value = "";
                    addListItem();
                });
                autoCompleteUL.appendChild(li);
            }
        };

        tag_input.addEventListener("keyup", async function() {
            await showAutoComplete();
        });

        tag_input.addEventListener("focus", async function() {
            await showAutoComplete();
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
            console.log(_userId);
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
            const isAdmin = result["isAdmin"];

            console.log(tickets);

            for (let ticket of tickets) {
                ticket.status = statuses[ticket.status];
                ticket.priority = priorities[ticket.priority];
            }

            drawTickets(tickets, isAdmin);

            ticketDropdown();
        });

        function drawTickets(tickets, isAdmin = false) {
            const section = document.querySelector('#tickets');
            section.innerHTML = '';
            for (const ticket of tickets) {

                const container = document.createElement('div');
                container.classList.add('ticket-container');

                const article = document.createElement('article');
                article.classList.add('ticket-box');
                article.classList.add('dash');

                const subject = document.createElement('h3');
                const subjectLink = document.createElement('a');
                subjectLink.href = `ticket.php?ticket=${ticket.id}`;
                subjectLink.textContent = ticket.subject;

                const status = document.createElement('p');
                status.textContent = "Status:";
                const statusTag = document.createElement('span');
                statusTag.classList.add('status-tag');
                statusTag.textContent = ticket.status;
                status.appendChild(statusTag);

                const priority = document.createElement('p');
                priority.textContent = "Priority:";
                const priorityTag = document.createElement('span');
                priorityTag.classList.add('priority-tag');
                priorityTag.textContent = ticket.priority;
                priority.appendChild(priorityTag);

                const description = document.createElement('p');
                description.textContent = ticket.description;

                const tags = document.createElement('ul');
                tags.classList.add('tags');
                for (const tag of ticket.tags) {
                    const li = document.createElement('li');
                    li.classList.add('tag');
                    li.textContent = tag;
                    tags.appendChild(li);
                }

                /* convert this to javascript in this context
                <button type=button class="dropdown-button"> 
						<i class="fa-solid fa-ellipsis-vertical"></i> 
                </button>
                <div class="ticket-dropdown dropdown">
                    <a href="../pages/editTicket.php?ticket=<?=$ticket->id?>">Edit</a>
                    <a href="../pages/deleteTicket.php?ticket=<?=$ticket->id?>">Delete</a>
                </div>*/

    
                if (isAdmin) {
                    const dropdownButton = document.createElement('button');
                    dropdownButton.type = 'button';
                    dropdownButton.classList.add('dropdown-button');
                    const dropdownIcon = document.createElement('i');
                    dropdownIcon.classList.add('fa-solid');
                    dropdownIcon.classList.add('fa-ellipsis-vertical');
                    dropdownButton.appendChild(dropdownIcon);
                    const dropdown = document.createElement('div');
                    dropdown.classList.add('ticket-dropdown');
                    dropdown.classList.add('dropdown');
                    const editLink = document.createElement('a');
                    editLink.href = `editTicket.php?ticket=${ticket.id}`;
                    editLink.textContent = "Edit";
                    const deleteLink = document.createElement('a');
                    deleteLink.href = `deleteTicket.php?ticket=${ticket.id}`;
                    deleteLink.textContent = "Delete";
                    dropdown.appendChild(editLink);
                    dropdown.appendChild(deleteLink);
                    container.appendChild(dropdownButton);
                    container.appendChild(dropdown);
                }

                subject.appendChild(subjectLink);
                article.appendChild(subject);
                article.appendChild(status);
                article.appendChild(priority);
                article.appendChild(description);
                article.appendChild(tags);
                container.appendChild(article);
                section.appendChild(container);
            }
        }
    }
};

function autoComplete(){

    

};

function userDropdown() {

    const userContainers = document.getElementsByClassName("user-container");
    
    if (userContainers.length == 0)
        return;

    for (const userContainer of userContainers) {

        dropdownButton = userContainer.getElementsByClassName("dropdown-button")[0];
        userDropdown = userContainer.getElementsByClassName("user-dropdown")[0];
        dropdownButton.addEventListener("click", function () {
            console.log("click");
            const dropdown = userContainer.getElementsByClassName("user-dropdown")[0];
            dropdown.classList.toggle("active");
        });
        userContainer.addEventListener("mouseleave", function () {
            const dropdown = userContainer.getElementsByClassName("user-dropdown")[0];
            dropdown.classList.remove("active");
        });
    }
}

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

function showError() {
    // Get the snackbar DIV
    var error = document.getElementById("error");
  
   if (error == null){
        return;
    }
    error.classList.toggle("show");
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ error.classList.toggle("show"); }, 4000);
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
            console.log(message.author + "|" + userID);

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
            img.src = "../images/profile.png";
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

function ticketDropdown(){

    const dropdowns = document.getElementsByClassName("ticket-dropdown");

    if (dropdowns.length == 0){
        return;
    }
    const dropdownButtons = document.getElementsByClassName("dropdown-button");

    for (const dropdownButton of dropdownButtons){
        dropdownButton.addEventListener("click", function() {
            dropdownButton.parentElement.getElementsByClassName("ticket-dropdown")[0].classList.toggle("active");
        });

        dropdownButton.parentElement.addEventListener("mouseleave", function() {
            dropdownButton.parentElement.getElementsByClassName("ticket-dropdown")[0].classList.remove("active");
        });
    } 

    const removeButtons = document.getElementsByClassName("remove-ticket");


    for (const removeButton of removeButtons){
        removeButton.addEventListener("click", function() {
            removeDialog = removeButton.parentElement.parentElement.getElementsByClassName("remove-dialog")[0];
            console.log(removeDialog);
            removeDialog.getElementsByClassName("cancel-button")[0].addEventListener("click", function() {
                removeDialog.close();
            });
            removeDialog.showModal();
        });
    }
}