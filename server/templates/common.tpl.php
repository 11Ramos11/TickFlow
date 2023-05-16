<?php function drawHeader($activeNavButton="none") { 

    $home = "";
    $tickets = "";
    $chat = "";
	$personnel = "";
    
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
		case "personnel":
			$personnel = "active";
			break;
    }

?>

<!DOCTYPE html>
<html>

<head>
	<title>TickFlow</title>
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
					<li class="<?=$tickets?>"> <a href="dashboard.php"><i class="fa-solid fa-ticket nav-button"></i>Dashboard</a></li>
					<li class="<?=$chat?>"><a href="chat.php"><i class="fa-regular fa-comments nav-button"></i>Chat</a></li>
					<li class="<?=$personnel?>"><a href="personnel.php"><i class="fa-solid fa-users nav-button"></i>Personnel</a></li>
				</ul>
			</nav>
			<a href="../actions/logout.action.php" class = "profile-button">Logout<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
		</div>

<?php } ?>

<?php 

include_once('../classes/my_error.class.php');

function drawFooter() { 
	
	$error = null;
	if (isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
	</div>
	<?php if ($error != null) { ?>
		<div id="error"> <?= $error->msg ?> </div>
	<?php } ?>
</body>

</html>

<?php } ?>