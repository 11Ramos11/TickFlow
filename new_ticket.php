<?php
    include_once("util.php");
	include_once("queries/departments_queries.php");

    session_start();

	if (!isset($_SESSION["user"])){
		header("Location: authentication.php");
		exit();
	}
    $user = $_SESSION["user"];

	$departments = getDepartments();
?>


<!DOCTYPE html>
<html>

<head>
	<title>Three-Column Layout with CSS Grid</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="new_ticket.css">
	<script src="https://kit.fontawesome.com/a45efa4a81.js" crossorigin="anonymous"></script>
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
				<h2>Create a New Ticket</h2>
			</section>
			<section id="ticket_form">
			<form action="queries/create_ticket.php" method="post">
				<label for="subject">Subject</label>
				<input type="text" class="input" id="subject" name="subject" placeholder="Subject">
				<label for="description">Description</label>
				<textarea id="description" class="input" name="description" placeholder="Description"></textarea>
				<label for="priority">Priority</label>
				<select id="priority" class="input" name="priority">	
					<option value="Normal">Normal</option>
					<option value="Urgent">Urgent</option>
					<option value="Immediate">Immediate</option>	
				</select>
				<section class="tags-searchbar">
				<ul class="tags-box tags" id="tag-creator">
					<input type="text" id="tag-input" name="tag" placeholder="Tags">
				</ul>
				<input type="hidden" id="tags" name="tags" placeholder="tags">
				</section>
				<label for="department">Department</label>
				<select id="department" class="input" name="department">
				<option value="-1">None</option>
					<?php foreach ($departments as $department) { ?>
						<option value="<?= $department->id; ?>"><?= $department->name; ?></option>
					<?php } ?>
				</select>
				<button type="submit" id="submit-button">Submit</button>
			</form>
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
<script src="create_tags_script.js"> </script>

</html>