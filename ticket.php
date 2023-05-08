<?php
    include_once("util.php");
	include_once("queries/tickets_queries.php");

    session_start();

	if (!isset($_SESSION["user"])){
		header("Location: authentication.php");
		exit();
	}
    $user = $_SESSION["user"];

	$ticketId = $_GET["ticket"];

    if (!userHasAccessToTicket($ticketId)){
        header("Location: tickets.php");
        exit();
    }

    $ticket = getTicket($ticketId);
?>


<!DOCTYPE html>
<html>

<head>
	<title>Three-Column Layout with CSS Grid</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://kit.fontawesome.com/a45efa4a81.js" crossorigin="anonymous"></script>
	<script src="script.js"></script>
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
					<li><a href="tickets.php"><i class="fa-solid fa-ticket"></i>Dashboard</a></li>
					<li><a href="chat.php"><i class="fa-regular fa-comments"></i>Chat</a></li>
				</ul>
			</nav>
			<a href="profile.php" class = "profile-button"><img src="images/profile.png" alt="Profile" class="profile-img"></img>Profile<i class="fa-solid fa-arrow-right-from-bracket"></i>
			</a>
		</div>
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
	</div>
</body>

</html>