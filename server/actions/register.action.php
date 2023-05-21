<?php

include_once(__DIR__.'/../classes/session.class.php');

$session = new Session();

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

$name = $_POST["name"];

if (!preg_match("/^[a-zA-Z\s]+$/i", $name)){
    $session->setError("Register", "Name must only contain letters and spaces");
    header("Location: ../pages/authentication.php");
    exit();
}
$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z0-9.]+@tickflow.com$/i", $email)){
    $session->setError("Register", "Email must be a valid TickFlow email (@tickflow.com)");
    header("Location: ../pages/authentication.php");
    exit();
}

$password = $_POST["pwd"];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){

    $session->setError("Register", "Password must be have at least 8 characters.\n Must contain at least one upper case letter, one number, and one special character");
    header("Location: ../pages/authentication.php");
    exit();
}

if ($name == "" || $email == "" || $password == ""){
    $session->setError("Register", "All fields are required");
    header("Location: ../pages/authentication.php");
    exit();
}

User::createUser($name, $email, $password, $session);

$session->setSuccess("Created Account", "Account created successfully");

header("Location: ../pages/authentication.php");  

?>