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
		header("Location: tickets.php");
		exit();
	}

    if (!$user->hasAccessToTicket($ticketId)){
        header("Location: tickets.php");
        exit();
    }

    $ticket = Ticket::getTicketByID($ticketId);

	drawHeader();
	drawTicket($ticket);
	drawFooter();
?>