<?php
    include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../classes/user.class.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/ticket.class.php');
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

	drawHeader();
	drawChat($ticket);
	drawBriefTicket($ticket);
	drawFooter();
?>