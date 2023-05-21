<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/faqEditor.tpl.php');
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

	if (!isset($_GET["id"])){
		$session->setError("No ID", "No ID was provided.");
		header("Location: home.php");
		exit();
	}

	$id = $_GET["id"];

	$faq = FAQ::getFAQbyID($id);

	drawHeader("home");
	drawFAQeditor($departments, $faq);
	drawRecentChanges($changes);
	drawFooter();
?>