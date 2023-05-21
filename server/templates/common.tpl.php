<?php function drawHeader($activeNavButton="none") { 

    $home = "";
    $tickets = "";
	$personnel = "";
	$admin = "";
    
    switch ($activeNavButton){
        case "home":
            $home = "active";
            break;
        case "dashboard":
            $tickets = "active";
            break;
		case "personnel":
			$personnel = "active";
			break;
		case "admin":
			$admin = "active";
			break;
    }

	$session = new Session();
	$isAdmin = $session->isAdmin();
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
	<button class="options-right"><i class="fa-solid fa-circle-info"></i></button>
	<button class="options-left"><i class="fa-solid fa-bars"></i></button>
	
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
					<li class="<?=$personnel?>"><a href="personnel.php"><i class="fa-solid fa-users nav-button"></i>Personnel</a></li>
					<?php if ($isAdmin) {  ?>
					<li class="<?=$admin?>"><a href="admin.php"><i class="fa-solid fa-sliders"></i> Administration 	</a></li>
					<?php } ?>
				</ul>
			</nav>
			<a href="../actions/logout.action.php" class = "profile-button">Logout<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
		</div>

<?php } ?>

<?php 

include_once('../classes/my_error.class.php');

function drawFooter() { 

	$session = new Session();
	
	$error = null;
	if ($session->hasError()) {
		$error = $session->getError();
		$session->unsetError();
	}

	$success = null;
	if ($session->hasSuccess()) {
		$success = $session->getSuccess();
		$session->unsetSuccess();
	}
?>
	</div>
	<?php if ($error != null) { ?>
		<div class="snack-bar" id="error" data-code=<?=$error->code?> > <?= $error->msg ?> </div>
	<?php } ?>
	<?php if ($success != null) { ?>
		<div class="snack-bar" id="success" data-code=<?=$success->code?> > <?= $success->msg ?> </div>
	<?php } ?>
</body>

</html>

<?php } ?>