<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/my_error.class.php');
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

$id = $_POST["id"];

$name = $_POST["name"];

if (!preg_match("/^[a-zA-Z\sãÃ]+$/", $name)){
    $session->setError("reg", "Name must only contain letters and spaces");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}
$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z0-9._]+@tickflow.com+$/", $email)){
    $session->setError("reg", "Email must be a valid TickFlow email (@tickflow.com)");
    error_log("Email must be a valid TickFlow email (@tickflow.com)");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$sessionUser = $session->getUser();

if (!isset($_POST["role"])){
    $role = $sessionUser->role; 
} else {
    $role = $_POST["role"];
}

if ($sessionUser->role == "Admin" && $role != "Admin" && $sessionUser->id == $id){
    if (count(User::getAdmins()) == 1){
        $session->setError("reg", "There must be at least one admin");
        header("Location: ../pages/dashboard.php?id=$id");  
        exit();
    }
}

if ($sessionUser->role == "Admin" && User::getUserById($id)->role == "Admin" && $sessionUser->id != $id){
    $session->setError("reg", "Admins cannot edit other admins");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

if ($role != "Admin" && $role != "Agent" && $role != "Client"){
    $session->setError("reg", "Role must be Admin, Agent or Client");
    header("Location: ../pages/dashboard.php?id=$id");  
    exit();
}

$db = getDatabaseConnection();
$query = $db->prepare("UPDATE User SET name = ?,email = ?,role = ? WHERE id = ?");
$result =  $query->execute(array($name,$email,$role, $id));

header("Location: ../pages/dashboard.php?id=$id");  

?>