<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/my_error.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');


$session = new Session();

$email = $_POST['email'];
$password = $_POST['pwd'];

if ($email == "" || $password == ""){
    $session->setError("log", "All fields are required");
    header("Location: ../authentication.php");
    exit();
}

$db = getDatabaseConnection();

$query = $db->prepare("SELECT * FROM User WHERE email = '$email' AND password = '$password' ");
$query->execute();

$users = $query->fetchAll();

$count = count($users);

if ($count == 1){

    $user_info = $users[0];

    $user = new User( $user_info['id'], $user_info['name'], $user_info['email'], $user_info['role']);
    $session->login($user);
    $session->unsetError();
    header("Location: ../pages/home.php");
    exit();
}
else{       
    $session->setError("log", "Email or password incorrect");
    header("Location: ../pages/authentication.php");
    exit();
}

?>