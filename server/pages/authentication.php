<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/my_error.class.php');
	include_once(__DIR__.'/../templates/authentication.tpl.php');

	$session = new Session();

	if ($session->isLoggedIn()){
		header("Location: home.php");
		exit();
	}

	$error = null;
	if ($session->hasError()){
		$error = $session->getError();
	}

	drawAuthentication($error);
?>