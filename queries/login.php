<?php

include_once("../util.php");

session_start();

$email = $_POST['email'];
$password = $_POST['pwd'];

if ($email == "" || $password == ""){
    $_SESSION["error"] = new MyError("Login", "All fields are required");
    header("Location: ../auth_page.php");
    exit();
}

$db = new PDO('sqlite:../database/database.db');

$query = $db->prepare("SELECT * FROM User WHERE email = '$email' AND password = '$password' ");
$query->execute();

$users = $query->fetchAll();

$count = count($users);

if ($count == 1){

    $_SESSION["email"] = $email;
    $_SESSION["name"] = $users[0]["name"];
    $_SESSION["error"] = "";
    header("Location: ../landing.php");
    exit();
}
else{       
    $_SESSION["error"] = new MyError("Login", "Email or password incorrect");
    header("Location: ../auth_page.php");
    exit();
}

?>