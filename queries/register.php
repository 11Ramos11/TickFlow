<?php

include_once("../util.php");

session_start();

$name = $_POST["name"];

if (!preg_match("/^[a-zA-Z\sãÃ]+$/", $name)){
    $_SESSION["error"] = new MyError("Register", "Name must only contain letters and spaces");
    header("Location: ../authentication.php");
    exit();
}
$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z0-9]+@companny.com+$/", $email)){
    $_SESSION["error"] = new MyError("Register", "Email must be in the format: <name>@companny.com");
    header("Location: ../authentication.php");
    exit();
}

$password = $_POST["pwd"];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
    $_SESSION["error"] = new MyError("Register", "Password must be have at least 8 characters.\n Must contain at least one upper case letter, one number, and one special character.");
    header("Location: ../authentication.php");
    exit();
}

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

header("Location: ../authentication.php");
    
?>