<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/faqCreator.tpl.php');
	include_once(__DIR__.'/../templates/changes.tpl.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/change.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$sessionUser = $session->getUser();

	if (!$sessionUser->isAgent()){
		$session->setError("No permissions", "You do not have permissions to create FAQs.");
		header("Location: home.php");
		exit();
	}

	$departments = Department::getDepartments();

	$changes = Change::getRecentChanges($sessionUser->id);

	drawHeader("home");
	drawFAQcreator($departments);
	drawRecentChanges($changes);
	drawFooter();
?>