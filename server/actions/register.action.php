<?php

include_once(__DIR__.'/../classes/session.class.php');

$session = new Session();

$name = $_POST["name"];

if (!preg_match("/^[a-zA-Z\sãÃ]+$/", $name)){
    $session->setError("Register", "Name must only contain letters and spaces");
    header("Location: ../pages/authentication.php");
    exit();
}
$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z0-9]+@tickflow.com+$/", $email)){
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


    $session->setError("Register", "Password must be have at least 8 characters.\n Must contain at least one upper case letter, one number, and one special character.");
    header("Location: ../pages/authentication.php");
    exit();
}

if ($name == "" || $email == "" || $password == ""){
    $session->setError("Register", "All fields are required");
    header("Location: ../pages/authentication.php");
    exit();
}

$db = new PDO('sqlite:../../database/database.db');
$query = $db->prepare("INSERT INTO User (name,email,password) VALUES ('$name','$email','$password')");

if ($query == false){
    $session->setError("Register", "Email already exists");
    header("Location: ../pages/authentication.php");
    exit();
}

$result = $query->execute();

if ($result == false){
    $session->setError("Register", "Email already exists");
    header("Location: ../pages/authentication.php");
    exit();
}

$session->setSuccess("Created Account", "Account created successfully");

header("Location: ../pages/authentication.php");  

?>