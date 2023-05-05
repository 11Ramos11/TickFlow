<?php
    include_once("util.php");
    session_start();
    $user = $_SESSION["user"];
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
					<li class="active"><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>
					<li><a href="tickets.php"><i class="fa-solid fa-ticket"></i>Dashboard</a></li>
					<li><a href="chat.php"><i class="fa-regular fa-comments"></i>Chat</a></li>
				</ul>
			
			</nav>

			<a href="profile.php" class = "profile-button"><img src="images/profile.png" alt="Profile" class="profile-img"></img>Profile<i class="fa-solid fa-arrow-right-from-bracket"></i>
			</a>
		</div>
		<main class="middle-column">
			<article>
				<h2>Middle Column</h2>
				<p>This is the content of the middle column.
				</p>
			</article>
			
		</main>
		<aside class="right-sidebar">
			<h2>Right Sidebar</h2>
			<p>This is the content of the right sidebar.</p>
		</aside>
	</div>
</body>

</html>