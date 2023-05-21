<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/faqs.tpl.php');
	include_once(__DIR__.'/../templates/changes.tpl.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/change.class.php');
	include_once(__DIR__.'/../classes/scripter.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$departments = Department::getDepartments();

	$sessionUser = $session->getUser();

	$changes = Change::getRecentChanges($sessionUser->id);

	$sessionUser = $session->getUser();

	$handlers = array(
		"dropdown.js",
		"responsiveness.js", 
		"snackbar.js"
	);
	$scripter = new Scripter("home.js", $handlers);

	drawHeader("home", $scripter);
	drawFAQS($departments, $sessionUser);
	drawRecentChanges($changes);
	drawFooter();
?>