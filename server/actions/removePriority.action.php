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

if (!$session->getUser()->isAdmin()){
    header("Location: ../pages/index.php");
    exit();
}

if (!isset($_POST["id"])){
    header("Location: ../pages/admin.php");
    exit();
}

$id = $_POST["id"];

Priority::removePriority($id);

$session->setSuccess("Item removed", "Priority removed successfully.");

header("Location: ../pages/admin.php");
?>
