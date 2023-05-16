<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/profile.tpl.php');
	include_once(__DIR__.'/../templates/tickets.tpl.php');
    include_once(__DIR__.'/../classes/user.class.php');
    include_once(__DIR__.'/../classes/ticket.class.php');
    include_once(__DIR__.'/../classes/department.class.php');
    

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
            header("Location: personnel.php");
            exit();
        }
    }

    $user = User::getUserById($id);
    $tickets = $user->getAllTickets();
    $departments = Department::getDepartments();

    $header = $id == $session->userID ? "dashboard" : null;
	drawHeader($header);
    drawTickets($departments, $tickets, $user, $session->getUser());
	drawProfile($user);
	drawFooter();
?>