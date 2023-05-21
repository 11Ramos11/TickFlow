<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/department.class.php'); 
include_once(__DIR__.'/../classes/status.class.php'); 
include_once(__DIR__.'/../classes/priority.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: ../pages/authentication.php");
    exit();
}

if (!isset($_POST['csrf'])){
    $session->setError("Missing arguments","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

if ($_POST['csrf'] !== $session->token){
    $session->setError("Unauthorized","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

if (!$session->getUser()->isAdmin()){
    $session->setError("No permissions", "You do not have permissions to remove priorities");
    header("Location: ../pages/index.php");
    exit();
}

if (!isset($_POST["id"])){
    $session->setError("Invalid input", "Try again later");
    header("Location: ../pages/admin.php");
    exit();
}

$id = $_POST["id"];

$priority = Priority::getPriorityById($id);

if ($priority->name == "Normal") {
    $session->setError("Invalid input", "You cannot remove the default priority");
    header("Location: ../pages/admin.php");
    exit();
}

if (Ticket::existsTicketsWithPriority($id)) {
    $session->setError("Priority in use", "You cannot remove a priority that is in use");
    header("Location: ../pages/admin.php");
    exit();
}

Priority::removePriority($id);

$session->setSuccess("Item removed", "Priority removed successfully");

header("Location: ../pages/admin.php");
?>
