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
			<h2>More info</h2>
			<section class="ticket-info-sidebar">
				<h3>Ticket Title</h3>
				<p>Ticket ID: <span class="id-tag"> #1E233</span></p>
				<p>Created: <span class="date">12/12/2021</span></p>
				<p>Status: <span class="status-tag">Open</span></p>
				<p>Priority: <span class="priority-tag">Urgent</span></p>
			</section>

			<section class ="assigned-to">
				<h3>Assigned To</h3>
				<div class = "person-card">
					<img src="../images/profile.png" alt="Profile" class="profile-img"></img>
					<p>John Doe</p>
				</div>
			</section>

			<section class="requester">
				<h3>Requester Detail</h3>
				<div class="person-card">
					<img src="../images/profile.png" alt="Profile" class="profile-img"></img>
					<p>John Doe</p>
				</div>
			</section>
	</aside>

<?php } ?>