<?php function drawHeader($activeNavButton="none") { 

    $home = "";
    $tickets = "";
    $chat = "";
    
    switch ($activeNavButton){
        case "home":
            $home = "active";
            break;
        case "tickets":
            $tickets = "active";
            break;
        case "chat":
            $chat = "active";
            break;
    }

?>

<!DOCTYPE html>
<html>

<head>
	<title>Three-Column Layout with CSS Grid</title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<script src="https://kit.fontawesome.com/a45efa4a81.js" crossorigin="anonymous"></script>
	<script src="../scripts/script.js"></script>
</head>

<body>
	<div class="grid-container" id="#main">
		<div class="left-sidebar">
			<header class="header">
				<img class="logo" src="../images/logo.svg" alt="Logo">
				<h1>TickFlow</h1>
			</header>
			<nav>
				<ul>
					<li class="<?=$home?>"><a href="home.php"><i class="fa-solid fa-house nav-button"></i>Home</a></li>
					<li class="<?=$tickets?>"> <a href="tickets.php"><i class="fa-solid fa-ticket nav-button"></i>Dashboard</a></li>
					<li class="<?=$chat?>"><a href="chat.php"><i class="fa-regular fa-comments nav-button"></i>Chat</a></li>
				</ul>
			
			</nav>

			<a href="profile.php" class = "profile-button"><img src="../images/profile.png" alt="Profile" class="profile-img"></img>Profile<i class="fa-solid fa-arrow-right-from-bracket"></i>
			</a>
		</div>

<?php } ?>

<?php function drawFooter() { ?>
	</div>
</body>

</html>

<?php } ?>