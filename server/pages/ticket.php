<?php
    include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/user.class.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/ticket.class.php');
	include_once(__DIR__.'/../templates/ticket.tpl.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../classes/scripter.class.php');

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

	$handlers = array(
		"chat.js",
		"faqChat.js",
		"responsiveness.js", 
		"snackbar.js"
	);
	$scripter = new Scripter("ticket.js", $handlers);

	$departments = Department::getDepartments();

	drawHeader("none", $scripter, "ticket");
	drawChat($ticket, $departments);
	drawBriefTicket($ticket, $author, $assignee, $department, $status, $priority, $user, "ticket");
	drawFooter();
?>