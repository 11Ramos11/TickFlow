<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/faqs.tpl.php');
	include_once(__DIR__.'/../templates/profile.tpl.php');
	include_once(__DIR__.'/../templates/changes.tpl.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/change.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$departments = Department::getDepartments();

	$changes = Change::getRecentChanges();

	$sessionUser = $session->getUser();

	drawHeader("home");
	drawFAQS($departments, $sessionUser);
	drawRecentChanges($changes);
	drawFooter();
?>