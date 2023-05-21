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
    header("Location: ../pages/index.php");
    exit();
}

if (!isset($_POST["name"])){
    header("Location: ../pages/admin.php");
    exit();
}

$name = $_POST["name"];
$name = trim($name);
if (strlen($name) == 0){
    header("Location: ../pages/admin.php");
    exit();
}

if (!preg_match('/^[a-zA-Z0-9 .,!?\s]+$/i', $name)){
    $session->setError("Invalid name", "The name of the priority cannot contain special characters");
    header("Location: ../pages/admin.php");
    exit();
}

$name = ucfirst($name);

Priority::createPriority($name);

$session->setSuccess("New item", "Priority added successfully");

header("Location: ../pages/admin.php");
?>
