<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/my_error.class.php');
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

$id = $session->userID;

$old

header("Location: ../pages/dashboard.php?id=$id");  


?>