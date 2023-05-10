<?php
    include_once("util.php");
	include_once("queries/tickets_queries.php");
	include_once("queries/departments_queries.php");

    session_start();

	if (!isset($_SESSION["user"])){
		header("Location: authentication.php");
		exit();
	}
    $user = $_SESSION["user"];

	$tickets = getTicketsForUser($user->id);

	$departments = getDepartments();
?>


<!DOCTYPE html>
<html>

<head>
	<title>Three-Column Layout with CSS Grid</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="create_tags_script.js"> </script>
</head>
<body>
	<div class="grid-container" id="#main">
		<div class="left-sidebar">
			<header class="header">
				<img class="logo" src="images/logo.svg" alt="Logo">
				<h1>TickSy</h1>
			</header>
			<nav>
				<ul>
					<li><a href="landing.php"><i class="fa-solid fa-house"></i>Home</a></li>
					<li class="active"><a href="tickets.php"><i class="fa-solid fa-ticket"></i>Dashboard</a></li>
					<li><a href="chat.php"><i class="fa-regular fa-comments"></i>Chat</a></li>
				</ul>
			</nav>
			<a href="profile.php" class = "profile-button"><img src="images/profile.png" alt="Profile" class="profile-img"></img>Profile<i class="fa-solid fa-arrow-right-from-bracket"></i>
			</a>
		</div>
		<main class="middle-column">
			<section class = "top">
				<h2>Tickets</h2>
				<a href="new_ticket.php"><button class = "button"> New Ticket</button> </a>
			</section>
			<section class="filter-tab">
				<select class="filter-dropdown">
					<option value="All">All Tickets</option>
					<option value="Open">My Tickets</option>
					<option value="Closed">Assigned Tickets</option>
					<option value="Pending">Others' Tickets</option>
				</select>
				<select class="filter-dropdown">
					<option value="All">Status</option>
					<option value="Open">Open</option>
					<option value="Closed">Closed</option>
					<option value="Pending">Pending</option>
				</select>
				<select class="filter-dropdown">
					<option value="All">Priority</option>
					<option value="Normal">Open</option>
					<option value="Urgent">Closed</option>
					<option value="Immeadiate">Pending</option>
				</select>
				<select class="filter-dropdown">
					<option value="-1">Department</option>
					<?php foreach ($departments as $department) { ?>
					<option value=<?=$department->id?>> <?=$department->name?> </option>
					<?php } ?>
				</select>
			</section>
			<section class="tags-searchbar">
				<ul class="tags-box tags" id="tag-creator">
					<input type="text" id="tag-input" name="tag" placeholder="Tag">
				</ul>
				<input type="hidden" id="tags" name="tags" value="">
				<button class="button" id="submit-button">Search</button>
			</section>
			<section class="content">
				<?php foreach ($tickets as $ticket) { ?>
				<a class="ticket-box" href="ticket.php?ticket=<?=$ticket->id?>">
				<section class="ticket-info">
					<h3><?=$ticket->subject?></h3>
					<p>Status: <span class="status-tag"><?=$ticket->status?></span></p>
					<p>Priority: <span class="priority-tag"><?=$ticket->priority?></span></p>
					<p>	<?=$ticket->description?> </p>
					<ul class="tags">
						<?php foreach ($ticket->tags as $tag) { ?>
						<li class="tag"> <?= $tag ?> </li>
						<?php } ?>
					</ul>
				</section>
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
	</div>
</body>

</html>