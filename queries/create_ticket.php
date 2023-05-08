<?php

include_once("../util.php");

session_start();

if (!isset($_SESSION["user"])){
    header("Location: authentication.php");
    exit();
}
$user = $_SESSION["user"];

error_log($user->name);

$subject = $_POST['subject'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$tags = $_POST['tags'];
$author =  $user->id;
$creattionDate = date("Y-m-d");
$creationTime = date("H:i:s");
$department = $_POST['department'];

$db = new PDO('sqlite:../database/database.db');

if ($department == -1){
    $query = $db->prepare("INSERT INTO Ticket (subject, description, priority, creationDate, creationTime, author) VALUES ('$subject', '$description', '$priority', '$creattionDate', '$creationTime', '$author')");
}
else {
    $query = $db->prepare("INSERT INTO Ticket (subject, description, priority, creationDate, creationTime, author, department) VALUES ('$subject', '$description', '$priority', '$creattionDate', '$creationTime', '$author', '$department')");
}
$result = $query->execute();

if ($result == FALSE){
    die("Something went wrong");
}

error_log($tags);

$ticketID = $db->lastInsertId();

$tags = explode(",", $tags);

foreach($tags as $tag){

    $tag = trim($tag);
    $query = $db->prepare("SELECT * FROM Hashtag WHERE name = '$tag'");
    $query->execute();
    $results = $query->fetchAll();
    if(count($results) == 0){
        $query = $db->prepare("INSERT INTO Hashtag (name) VALUES ('$tag')");
        $query->execute();
        $hashtagID = $db->lastInsertId();
    } else {
        $hashtagID = $results[0]['id'];
    }

    $query = $db->prepare("INSERT INTO Ticket_Hashtag (ticket, hashtag) VALUES ('$ticketID', '$hashtagID')");
    $query->execute();
}

header("Location: ../ticket.php?ticket=$ticketID");

?>