<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/home.tpl.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/change.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$departments = Department::getDepartments();

	$changes = Change::getRecentChanges();

	drawHeader("home");
	drawFAQS($departments);
	drawRecentChanges($changes);
	drawFooter();
?>