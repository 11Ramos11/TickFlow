<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/connection.db.php');


$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: ../pages/authentication.php");
    exit();
}

if (!isset($_POST['pwd']) || !isset($_POST['confirm-pwd'])){
    $session->setError("Missing arguments","Please fill both fields");
    header("Location: ../pages/dashboard.php");
    exit();
}

if (!isset($_POST['id'])){
    $session->setError("Missing arguments","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

$password = $_POST['pwd'];
$confirmPassword = $_POST['confirm-pwd'];
$id = $_POST['id'];

// password cant contain ?, < and > because of html and sql injection risk 

if (!is_numeric($id)){
    $session->setError("Bad input","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

if (strpos($password, '?') !== false || strpos($password, '<') !== false || strpos($password, '>') !== false){
    $session->setError("Bad input","Password can't contain '?', '<' or '>'");
    header("Location: ../pages/dashboard.php");
    exit();
}

if ($session->userID !== $id){
    $session->setError("Unauthorized","You can only change your own password");
    header("Location: ../pages/dashboard.php");
    exit();
}

if ($password !== $confirmPassword){
    $session->setError("Bad input","Passwords do not match");
    header("Location: ../pages/dashboard.php");
    exit();
}

if (strlen($password) < 8){
    $session->setError("Bad input","Password must be at least 8 characters long");
    header("Location: ../pages/dashboard.php");
    exit();
}

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){

    $session->setError("Bad input", "Password must contain at least one upper and lower case letter, one number, and one special character.");
    header("Location: ../pages/dashboard.php");
    exit();
}

$noSpaces = preg_match('/\s/', $password);

if ($noSpaces){
    $session->setError("Bad input","Password can't contain spaces");
    header("Location: ../pages/dashboard.php");
    exit();
}

$user = $session->getUser();
$user->setPassword($password);

$session->setSuccess("Field changed","Your password has been changed successfully");

header("Location: ../pages/dashboard.php");  

?>