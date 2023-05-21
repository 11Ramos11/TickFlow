<?php

require_once(__DIR__.'/classes/session.class.php');

$session = new Session();

$password = "Password1!";
//die(password_hash($password, PASSWORD_DEFAULT));

if ($session->isLoggedIn()){
    header("Location: pages/home.php");
    exit();
} else {
    header("Location: pages/authentication.php");
    exit();
}

?>