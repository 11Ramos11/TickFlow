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

if (!isset($_POST["id"]) || !isset($_POST["name"])){
    header("Location: ../pages/admin.php");
    exit();
}

$id = $_POST["id"];
$name = $_POST["name"];
$name = trim($name);
if (strlen($name) == 0){
    header("Location: ../pages/admin.php");
    exit();
}
$name = ucfirst($name);

Priority::editPriority($id, $name);

$session->setSuccess("Item edited", "Priority edited successfully.");

header("Location: ../pages/admin.php");
?>
