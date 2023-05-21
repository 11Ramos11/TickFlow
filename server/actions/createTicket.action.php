<?php


include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: authentication.php");
    exit();
}

$user = $session->getUser();

if (!isset($_POST['subject'])){
    $session->setError("No subject", "No subject was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['description'])){
    $session->setError("No description", "No description was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['priority'])){
    $session->setError("No priority", "No priority was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['department'])){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

$subject = trim($_POST['subject']);
$description = trim($_POST['description']);
$priority = $_POST['priority'];
$tags = trim($_POST['tags']);
$author =  $user->id;
$creationDate = date("Y-m-d");
$creationTime = date("H:i:s");
$department = trim($_POST['department']);


if ($subject == ""){
    $session->setError("No subject", "No subject was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($description == ""){
    $session->setError("No description", "No description was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($priority == ""){
    $session->setError("No priority", "No priority was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($department == ""){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (strlen($subject) > 255){
    $session->setError("Subject too long", "The subject is too long.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

Ticket::createTicket($subject, $description, $priority, $creationDate, $creationTime, $author, $department, $tags);

$session->setSuccess("Ticket created", "The ticket was successfully created.");

header("Location: ../pages/ticket.php?ticket=$ticketID");

?>