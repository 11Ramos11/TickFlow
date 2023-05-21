let tags = [];

function remove(element, tag){
    tags = tags.filter(t => t != tag);
    element.parentElement.remove();
}

async function tagsHandler() {

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

