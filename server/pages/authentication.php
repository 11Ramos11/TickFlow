<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/errorMsg.class.php');
	include_once(__DIR__.'/../templates/authentication.tpl.php');

	$session = new Session();

	if ($session->isLoggedIn()){
		header("Location: home.php");
		exit();
	}
	
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

	drawAuthentication($error, $success, $session);
?>