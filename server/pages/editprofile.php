<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/editProfile.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    if (!isset($_GET['id'])) {
        $id = $session->user->id;
    }
    else {
        $id = $_GET['id'];

        if (!$session->user->isAdmin() && $session->user->id != $id) {
            header("Location: personnel.php");
            exit();
        }
    }

    $user = User::getUserById($id);

	drawHeader();
	drawEditProfile($user);
	drawFooter();
?>