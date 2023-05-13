<?php 

include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/department.class.php');

function drawTicket($ticket) { 
    $author =  User::getUserById($ticket->authorID);
	$assignedTo = User::getUserById($ticket->assignedID);
	$department = Department::getDepatmentByID($ticket->departmentID);
?>
    <main class="middle-column">
			<section class = "top">
				<h2><?=$ticket->subject?></h2>
			</section>
			<section class ="ticketbody">
				<p>Created: <span class="date"><?=$ticket->date?></span></p>
				<p>Status: <span class="status-tag"><?=$ticket->status?></span></p>
				<p>Priority: <span class="priority-tag"><?=$ticket->priority?></span></p>
				<ul class="tags">
					<?php foreach ($ticket->tags as $tag) { ?>
					<li class="tag"> <?= $tag ?> </li>
					<?php } ?>
				</ul>
                <p><?=$ticket->description?></p>
				<p>Written by <a href="profile.php?user=<?=$author->id?>"><?=$author->name?></a> </p>
				<?php if ($assignedTo != null) { ?>
					<p>Assigned to <a href="profile.php?user=<?=$assignedTo->id?>"><?=$assignedTo->name?></a> </p>
				<?php } else { ?>
					<p>Not Assigned </p>
				<?php } ?>
				<p>Department: <a><?=$department == null ? "None" : $department->name?></a> </p>
			</section>
		</main>
		<aside class="right-sidebar">
			<!--- <h2>More info</h2>
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
			</section> --->
		</aside>

<?php } ?>