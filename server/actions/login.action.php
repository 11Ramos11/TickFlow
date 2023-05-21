<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');


$session = new Session();

$email = $_POST['email'];
$password = $_POST['pwd'];

if ($email == "" || $password == ""){
    $session->setError("Login", "Please fill both fields");
    header("Location: ../pages/authentication.php");
    exit();
}

if (!preg_match("/^[a-zA-Z0-9.]+@tickflow.com$/i", $email)){
    $session->setError("Login", "Email must be a valid TickFlow email (user.name123@tickflow.com)");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$user = User::getUserByLogin($email, $password);

if ($user != null){

    $session->login($user->id);

    header("Location: ../pages/home.php");
    exit();
}
else{       
    $session->setError("Login", "Email or password incorrect");
    header("Location: ../pages/authentication.php");
    exit();
}

?>