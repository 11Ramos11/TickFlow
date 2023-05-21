<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/profile.tpl.php');
	include_once(__DIR__.'/../templates/tickets.tpl.php');
    include_once(__DIR__.'/../classes/user.class.php');
    include_once(__DIR__.'/../classes/ticket.class.php');
    include_once(__DIR__.'/../classes/department.class.php');
    include_once(__DIR__.'/../classes/status.class.php');
    include_once(__DIR__.'/../classes/priority.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    if (!isset($_GET['id'])) {
        $id = $session->userID;
    }
    else {
        $id = $_GET['id'];

        if (!$session->isAdmin() && $session->userID != $id) {
            $session->setError("No perms", "You don't have permission to access that page.");
            header("Location: dashboard.php");
            exit();
        }

        if ($id == $session->userID) {
            header("Location: dashboard.php");
            exit();
        }
    }

    $user = User::getUserById($id);
    if ($id === $session->userID) {
        $tickets = $user->getAllTickets();
    } else {
        $tickets = array_merge($user->getAuthoredTickets(), $user->getAssignedTickets());
    }
    $departments = Department::getDepartments();
    $statuses = Status::getStatuses();
    $priorities = Priority::getPriorities();

    $header = $id == $session->userID ? "dashboard" : null;
	drawHeader($header);
    drawTickets($departments, $tickets, $user, $session->getUser(), $statuses, $priorities);
	drawProfile($user, $departments);
	drawFooter();
?>