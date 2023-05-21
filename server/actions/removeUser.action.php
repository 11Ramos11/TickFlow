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

if (!isset($_GET['csrf'])){
    $session->setError("Missing arguments","Refresh and try again");
    header("Location: ../pages/personnel.php");
    exit();
}

if ($_GET['csrf'] !== $session->token){
    $session->setError("Unauthorized","Refresh and try again");
    header("Location: ../pages/personnel.php");
    exit();
}

if (!$session->getUser()->isAdmin()){

    $session->setError("Unauthorized","You are not authorized to perform this action");
    header("Location: ../pages/personnel.php");
    exit();
}

if (!isset($_GET["id"])){

    $session->setError("Missing arguments","Refresh and try again");
    header("Location: ../pages/personnel.php");
    exit();
}

$id = $_GET["id"];

$user = User::getUserByID($id);

if ($user->isAdmin()){

    $session->setError("Invalid input","You cannot remove an admin");
    header("Location: ../pages/personnel.php");
    exit();
}

User::removeUser($id);

$session->setSuccess("Item removed", "User removed successfully");

header("Location: ../pages/personnel.php");
?>
