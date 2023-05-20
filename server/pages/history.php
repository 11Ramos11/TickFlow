<?php
    include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/user.class.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/ticket.class.php');
	include_once(__DIR__.'/../templates/changes.tpl.php');
	include_once(__DIR__.'/../templates/ticket.tpl.php');
	include_once(__DIR__.'/../templates/common.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    $user = $session->getUser();

	if (isset($_GET["ticket"])){
		$ticketId = $_GET["ticket"];
	} else {
		header("Location: dashboard.php");
		exit();
	}

    if (!$user->hasAccessToTicket($ticketId)){
        header("Location: dashboard.php");
        exit();
    }

    $ticket = Ticket::getTicketByID($ticketId);

	$author =  User::getUserById($ticket->authorID);
	if ($ticket->assigneeID != null)
		$assignee = User::getUserById($ticket->assigneeID);
	else
		$assignee = null;
	$department = Department::getDepatmentByID($ticket->departmentID);
	$status = Status::getStatusById($ticket->status);
	$priority = Priority::getPriorityById($ticket->priority);

	$changes = $ticket->getChanges();

	error_log($ticket->subject);

	drawHeader();
	drawChanges($ticket, $changes);
	drawBriefTicket($ticket, $author, $assignee, $department, $status, $priority, $user, "history");
	drawFooter();
?>