<?php
    include_once(__DIR__.'/../classes/connection.db.php');
	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/user.class.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../templates/tickets.tpl.php');
	include_once(__DIR__.'/../templates/common.tpl.php');


	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}
    $user = $session->user;

	if ($user->role == 'Admin')
		$tickets = Ticket::getAllTickets();
	else{
		$tickets = $user->getAllTickets();
	}

	$departments = Department::getDepartments();

	drawHeader("tickets");
	drawTickets($departments, $tickets);
	drawFooter();
?>