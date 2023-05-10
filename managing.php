//code template for php file
<?php
include_once("../util.php");

session_start();

if (!isset($_SESSION["user"])){
    header("Location: ../authentication.php");
    exit();
}

$user = $_SESSION["user"];
/*
if ($user->getRole() != "admin"){
    header("Location: ../landing.php");
    exit();
}

$ticket_id = $_GET['id'];

$db = new PDO('sqlite:../database/database.db');

$query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticket_id' ");

$query->execute();
*/