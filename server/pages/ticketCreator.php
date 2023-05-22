<?php
    
	require_once(__DIR__.'/../classes/session.class.php');
	require_once(__DIR__.'/../classes/department.class.php');
	require_once(__DIR__.'/../classes/priority.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/ticketCreator.tpl.php');
	include_once(__DIR__.'/../classes/scripter.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$departments = Department::getDepartments();
	$priorities = Priority::getPriorities();

	$handlers = array(
		"tags.js",
		"responsiveness.js", 
		"snackbar.js"
	);
	$scripter = new Scripter("ticketCreator.js", $handlers);

	drawHeader("none", $scripter, "ticketForm");
	drawTicketCreator($departments, $priorities, $session);
	drawFooter();
?>