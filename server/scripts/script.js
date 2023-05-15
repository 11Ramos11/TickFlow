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
};

function createTags() {
    const tagsList = document.getElementById("tag-creator");
    const input = document.getElementById("tag-input");

    if (tagsList == null || input == null){
        return;
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

    tagsList.addEventListener("keyup", addTag);

    const submitButton = document.getElementById("submit-button");

    if (submitButton != null){
        submitButton.addEventListener("click", () => {
            let tagsInput = document.getElementById("tags");
            tagsInput.value = tags;
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

            const userIdHolder = document.getElementById('user-id-holder');
            const _userId = userIdHolder != null ? userIdHolder.textContent : null;
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
            const tickets = await response.json();

            if (tickets == null) {
                alert("Error fetching tickets");
                return;
            }

            drawTickets(tickets);
        });

        function drawTickets(tickets) {
            const section = document.querySelector('#tickets');
            section.innerHTML = '';
            for (const ticket of tickets) {

                const link = document.createElement('a');
                link.classList.add('ticket-box');
                link.href = 'ticket.php?ticket=' + ticket.id;

                const article = document.createElement('article');
                article.classList.add('ticket-info');

                const subject = document.createElement('h3');
                subject.textContent = ticket.subject;

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

                article.appendChild(subject);
                article.appendChild(status);
                article.appendChild(priority);
                article.appendChild(description);
                article.appendChild(tags);
                link.appendChild(article);
                section.appendChild(link);
            }
        }
    }
};

function userDropdown() {

    const userCards = document.getElementsByClassName("user-card");

    function hideUserDropdowns(){
        for (const card of userCards) {
            const dropdown = card.getElementsByClassName("dropdown")[0];
            dropdown.classList.remove("active");
        }
    }
    
    for (const card of userCards) {
        card.addEventListener("click", function () {
            hideUserDropdowns();
            const dropdown = this.getElementsByClassName("dropdown")[0];
            dropdown.classList.toggle("active");
        });

        card.addEventListener("mouseleave", function () {
            hideUserDropdowns();
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
            toggleProfile();
        });

        cancelButton.addEventListener("click", function() {

            const nameInfo = document.getElementById("name-info");
            const emailInfo = document.getElementById("email-info");
            const roleInfo = document.getElementById("role-info");
            const nameEditor = document.getElementById("name-editor");
            const emailEditor = document.getElementById("email-editor");
            console.log("|" + roleInfo.textContent + "|")
            const roleOption = document.getElementById(roleInfo.textContent);

            nameEditor.value = nameInfo.textContent;
            emailEditor.value = emailInfo.textContent;
            roleOption.setAttribute("selected",  "selected")


            toggleProfile();
        });
    }
}