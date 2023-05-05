<?php

session_start();

if (!isset($_SESSION["user"])){
    header("Location: auth_page.php");
    exit();
} else {
    header("Location: landing.php");
    exit();
}

?>