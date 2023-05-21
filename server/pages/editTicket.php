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
	include_once(__DIR__.'/../classes/scripter.class.php');

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

	$author =  User::getUserById($ticket->authorID);
	if ($ticket->assigneeID != null)
		$assignee = User::getUserById($ticket->assigneeID);
	else
		$assignee = null;
	$department = Department::getDepatmentByID($ticket->departmentID);
	$status = Status::getStatusById($ticket->status);
	$priority = Priority::getPriorityById($ticket->priority);

	if ($department != null)
		$users = $department->getUsers();
	else
		$users = array();

	$handlers = array(
		"tags.js",
		"ticketEditor.js",
		"responsiveness.js", 
		"snackbar.js"
	);
	$scripter = new Scripter("ticketEditor.js", $handlers);

	drawHeader("none", $scripter);
    drawTicketEditor($departments, $priorities, $statuses, $users, $ticket, $sessionUser, $session);
	drawBriefTicket($ticket, $author, $assignee, $department, $status, $priority, $sessionUser, "edit");
	drawFooter();
?>