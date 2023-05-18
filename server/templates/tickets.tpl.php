<?php function drawTickets($departments, $tickets, $user, $sessionUser) {  ?>

	<p hidden id="user-id-holder"><?=$user->id?></p>
    <main class="middle-column">
		<section id="tickets-search">
			<section class="top">
				<section class = "title">
					<?php if($user->id == $sessionUser->id) { ?>
					<h2>My Tickets</h2>
					<a href="ticketCreator.php"><button class = "button"> New Ticket</button> </a>
					<?php } else { ?>
					<h2><?=$user->name?>'s Tickets</h2>
					<?php } ?>
				</section>
				<section id="searchBar">
					<section id="filter-tab">
						<?php if ($user->role != "Client") { ?> 
						<select id="ownership-filter" class="filter-dropdown">
							<option value="All">All Tickets</option>
							<option value="Author">Created Tickets</option>
							<option value="Assigned">Assigned Tickets</option>
							<?php if ($user->role == "Admin" && $sessionUser->id == $user->id) { ?> 
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
						<?php if ($user->role != "Client") { ?> 
						<select id="department-filter" class="filter-dropdown">
							<option value="All">Any Department</option>
							<?php foreach ($departments as $department) { ?>
							<option value=<?=$department->id?>> <?=$department->name?> </option>
							<?php } ?>
							<option value="None">None</option>
						</select>
						<?php } ?>
					</section>
					<section class="tags-searchbar flex-fix">
						<ul class="tags-box tags max-width" id="tag-creator">
							<input type="text" id="tag-input" name="tag" placeholder="Tag">
						</ul>
						<input type="hidden" id="tags" name="tags" value="">
						<button class="button" id="search-button">Search</button>
					</section>
				</section>
			</section>
			<section id="tickets" class="content">
				<?php foreach ($tickets as $ticket) { ?>
				<a class="ticket-info" href="ticket.php?ticket=<?=$ticket->id?>">
				<article class="ticket-box dash">
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
		</section>
	</main>
<?php } ?>