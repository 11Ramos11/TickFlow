<?php

require_once(__DIR__.'/classes/session.class.php');

$session = new Session();

if ($session->isLoggedIn()){
    header("Location: pages/home.php");
    exit();
} else {
    header("Location: pages/authentication.php");
    exit();
}

?>