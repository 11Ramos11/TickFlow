<?php function drawTickets($departments, $tickets, $role) {  ?>

    <main class="middle-column">
			<section class = "top">
				<h2>Tickets</h2>
				<a href="ticketCreator.php"><button class = "button"> New Ticket</button> </a>
			</section>
			
			<section id="searchBar">
				<section id="filter-tab">
					<?php if ($role != "Client") { ?> 
					<select id="ownership-filter" class="filter-dropdown">
						<option value="All">All Tickets</option>
						<option value="Author">My Tickets</option>
						<option value="Assigned">Assigned Tickets</option>
						<?php if ($role = "Client") { ?> 
						<option value="Others">Others' Tickets</option>
						<?php } ?>	
					</select>
					<?php } ?>
					<select id="status-filter" class="filter-dropdown">
						<option value="All">Any Status</option>
						<option value="Open">Open</option>
						<option value="Closed">Closed</option>
						<option value="Pending">Pending</option>
					</select>
					<select id="priority-filter" class="filter-dropdown">
						<option value="All">Any Priority</option>
						<option value="Normal">Normal</option>
						<option value="Urgent">Urgent</option>
						<option value="Immediate">Immediate</option>
					</select>
					<?php if ($role != "Client") { ?> 
					<select id="department-filter" class="filter-dropdown">
						<option value="All">Any Department</option>
						<?php foreach ($departments as $department) { ?>
						<option value=<?=$department->id?>> <?=$department->name?> </option>
						<?php } ?>
						<option value="None">None</option>
					</select>
					<?php } ?>
				</section>
				<section class="tags-searchbar">
					<ul class="tags-box tags" id="tag-creator">
						<input type="text" id="tag-input" name="tag" placeholder="Tag">
					</ul>
					<input type="hidden" id="tags" name="tags" value="">
					<button class="button" id="search-button">Search</button>
				</section>
			</section>
			<section id="tickets" class="content">
				<?php foreach ($tickets as $ticket) { ?>
				<a class="ticket-box" href="ticket.php?ticket=<?=$ticket->id?>">
				<article class="ticket-info">
					<h3><?=$ticket->subject?></h3>
					<p>Status:<span class="status-tag"><?=$ticket->status?></span></p>
					<p>Priority:<span class="priority-tag"><?=$ticket->priority?></span></p>
					<p>	<?=$ticket->description?> </p>
					<ul class="tags">
						<?php foreach ($ticket->tags as $tag) { ?>
						<li class="tag"> <?= $tag ?> </li>
						<?php } ?>
					</ul>
				</article>
				</a>
				<?php } ?>
			</section>
		</main>
		<!--
		<aside class="right-sidebar">
			<h2>More info</h2>
			<section class="ticket-info">
				<h3>Ticket Title	</h3>
				<p>Ticket ID: <span class="id-tag"> #1E233</span></p>
				<p>Created: <span class="date">12/12/2021</span></p>
				<p>Status: <span class="status-tag">Open</span></p>
				<p>Priority: <span class="priority-tag">Urgent</span></p>
			</section>

			<section class ="assigned-to">
				<h3>Assigned To</h3>
				<div class = "person-card">
					<img src="images/profile.png" alt="Profile" class="profile-img"></img>
					<p>John Doe</p>
				</div>
			</section>

			<section class="requester">
				<h3>Requester Detail</h3>
				<div class="person-card">
					<img src="images/profile.png" alt="Profile" class="profile-img"></img>
					<p>John Doe</p>
				</div>
			</section>
		</aside>
		-->

<?php } ?>