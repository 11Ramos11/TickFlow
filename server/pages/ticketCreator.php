<?php
    
	require_once(__DIR__.'/../classes/session.class.php');
	require_once(__DIR__.'/../classes/department.class.php');
	require_once(__DIR__.'/../classes/priority.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/ticketCreator.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	$departments = Department::getDepartments();
	$priorities = Priority::getPriorities();

	drawHeader();
	drawTicketCreator($departments, $priorities, $session);
	drawFooter();
?>