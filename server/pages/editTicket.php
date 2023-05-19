<?php
    include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/user.class.php');
	include_once(__DIR__.'/../classes/department.class.php');
    include_once(__DIR__.'/../classes/status.class.php');
    include_once(__DIR__.'/../classes/priority.class.php');
	include_once(__DIR__.'/../classes/ticket.class.php');
	include_once(__DIR__.'/../templates/ticket.tpl.php');
	include_once(__DIR__.'/../templates/ticketEditor.tpl.php');
	include_once(__DIR__.'/../templates/common.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    $sessionUser = $session->getUser();

	if (isset($_GET["ticket"])){
		$ticketId = $_GET["ticket"];
	} else {
		header("Location: dashboard.php");
		exit();
	}

    if (!$sessionUser->hasAccessToTicket($ticketId)){
        header("Location: dashboard.php");
        exit();
    }

    $ticket = Ticket::getTicketByID($ticketId);
    $departments = Department::getDepartments();
	$priorities = Priority::getPriorities();
	$statuses = Status::getStatuses();
	$users = User::getAllUsers();

	drawHeader();
    drawTicketEditor($departments, $priorities, $statuses, $users, $ticket, $sessionUser);
	drawBriefTicket($ticket);
	drawFooter();
?>