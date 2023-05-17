<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/my_error.class.php');
include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/chat.class.php');

$session = new Session();

$ticketID = $_POST["ticketID"];
$userID = $_POST["userID"];

error_log("ticketID: $ticketID");
error_log("userID: $userID");

$ticket = Ticket::getTicketByID($ticketID);

$chat = $ticket->getChat();

if (isset($_POST["message"])){
    $message = $_POST["message"];
    $chat->addMessage($message, $userID);
}

$newMessages = $chat->getMessages();

echo json_encode($newMessages);