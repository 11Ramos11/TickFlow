<?php
    include_once(__DIR__.'/../classes/session.class.php');
    include_once(__DIR__.'/../templates/personnel.tpl.php');
    include_once(__DIR__.'/../templates/common.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    drawHeader("personnel");
    drawPersonnel();
    drawFooter();
?>