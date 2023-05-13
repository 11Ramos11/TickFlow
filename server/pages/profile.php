<?php
    include_once(__DIR__.'/../classes/session.class.php');
    include_once(__DIR__.'/../classes/user.class.php');
    include_once(__DIR__.'/../templates/profile.tpl.php');
    include_once(__DIR__.'/../templates/common.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    $sessionUser = $session->user;

    if (!isset($_GET["user"])){
        $user = $sessionUser;
    } else {
        $userID = $_GET["user"];
        $user = User::getUserById($userID);
    } 

    drawHeader();
    drawProfile($sessionUser, $user);
    drawFooter();
?>