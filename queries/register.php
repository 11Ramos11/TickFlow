<?php

include_once("../util.php");

session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["pwd"];

if ($name == "" || $email == "" || $password == ""){
    $_SESSION["error"] = new MyError("Register", "All fields are required");
    header("Location: ../auth_page.php");
    exit();
}

$db = new PDO('sqlite:../database/database.db');
$query = $db->prepare("INSERT INTO User (name,email,password) VALUES ('$name','$email','$password')");

if ($query == false){
    $_SESSION["error"] = new MyError("Register", "Email already exists");
    header("Location: ../authentication.php");
    exit();
}

$result = $query->execute();

if ($result == false){
    $_SESSION["error"] = new MyError("Register", "Email already exists");
    header("Location: ../authentication.php");
    exit();
}

$_SESSION["user"] = new User($email, $name, "user");
header("Location: ../landing.php");
    
?>