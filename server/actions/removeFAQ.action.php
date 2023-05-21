<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/department.class.php'); 
include_once(__DIR__.'/../classes/status.class.php'); 
include_once(__DIR__.'/../classes/priority.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/faq.class.php');

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

if (!$session->getUser()->isAgent()){
    $session->setError("No permissions", "You do not have permissions to remove this FAQ");
    header("Location: ../pages/home.php");
    exit();
}

if (!isset($_POST["faq"])){
    $session->setError("No FAQ", "No FAQ was provided");
    header("Location: ../pages/home.php");
    exit();
}

$faq = $_POST["faq"];

FAQ::removeFAQ($faq);

$session->setSuccess("Item removed", "FAQ removed successfully");

header("Location: ../pages/home.php");
?>
