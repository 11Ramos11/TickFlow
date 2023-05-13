<?php function drawChat() { ?>

    <main>
        <section id="chat">
            <div class = "messages">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                <article class="msg msg-left">
                    <figure class="avatar">
                        <img src="../images/profile.png" alt="Avatar">
                    </figure>
                    <div class="bubble">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                    </div>
                </article>
                <article class="msg msg-right">
                    <div class="bubble">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                    </div>
                    <figure class="avatar">
                        <img src="../images/profile.png" alt="Avatar">
                    </figure>
                </article>
                <?php } ?>
            </div>
            <form action="/submit-message" method="post" class="reply">
                <input type="text">
                <button>Reply</button>
            </form>  
        </section>   
            
    </main>
    <aside class="right-sidebar">
            <h2>Chat Information</h2>
            <div class="chat-info">
                <h3>User Status</h3>
                <ul>
                    <li>Online: <span class="online-status">5</span></li>
                    <li>Offline: <span class="offline-status">3</span></li>
                </ul>
            </div>
            <div class="active-users">
                <h3>Active Users</h3>
                <ul>
                    <li>User1</li>
                    <li>User2</li>
                    <li>User3</li>
                    <li>User4</li>
                    <li>User5</li>
                </ul>
            </div>
            <div class="chat-tips">
                <h3>Chat Tips</h3>
                <p>1. Be respectful to others in the chat.</p>
                <p>2. Keep the conversation relevant to the topic.</p>
                <p>3. Do not share personal information.</p>
                <p>4. Use appropriate language and avoid offensive content.</p>
            </div>
        </aside>

<?php } ?>