/* Tags */

let tags = [];


function remove(element, tag){
    tags = tags.filter(t => t != tag);
    element.parentElement.remove();
}

window.onload = function () {
    createTags();
    filterTickets();
};

function createTags() {
    const tagsList = document.getElementById("tag-creator");
    const input = document.getElementById("tag-input");

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
    return fetch('../actions/filterTickets.action.php', {
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

            const _ownership = document.getElementById('ownership-filter').value;
            const _status = document.getElementById('status-filter').value;
            const _priority = document.getElementById('priority-filter').value;
            const _department = document.getElementById('department-filter').value;
            const _tags = tags.join(",");

            const response = await getFilteredTickets({
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