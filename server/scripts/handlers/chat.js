function chatHandler(){

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