<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/my_error.class.php'); 
include_once(__DIR__.'/../classes/department.class.php'); 
include_once(__DIR__.'/../classes/status.class.php'); 
include_once(__DIR__.'/../classes/priority.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: ../pages/authentication.php");
    exit();
}

if (!isset($_POST["id"])){
    $session->setError("No ticket ID", "No ticket ID was provided.");
    header("Location: ../pages/dashboard.php");
    exit();
}

$id = $_POST["id"];

$ticket = Ticket::getTicketByID($id);

if ($ticket == null){
    $session->setError("No ticket", "No ticket with the provided ID was found.");
    header("Location: ../pages/dashboard.php");
    exit();
}

$sessionUser = $session->getUser();

if (!$sessionUser->hasAccessToTicket($id)){
    $session->setError("No permissions", "You do not have permissions to remove this ticket.");
    header("Location: ../pages/dashboard.php");
    exit();
}

if ($sessionUser->isClient()){
    $ticket->removeAuthor();
}

Ticket::removeTicket($id);

$session->setSuccess("Ticket removed", "Ticket removed successfully."); 

header("Location: ../pages/dashboard.php");
?>
