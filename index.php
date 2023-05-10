<?php

session_start();

if (!isset($_SESSION["user"])){
    header("Location: authentication.php");
    exit();
} else {
    header("Location: landing.php");
    exit();
}

?>