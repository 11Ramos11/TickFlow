<?php


include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/my_error.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: authentication.php");
    exit();
}

$user = $session->getUser();

$subject = $_POST['subject'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$tags = $_POST['tags'];
$author =  $user->id;
$creationDate = date("Y-m-d");
$creationTime = date("H:i:s");
$department = $_POST['department'];

error_log($priority);

$db = getDatabaseConnection();

if ($department == -1){
    $query = $db->prepare("INSERT INTO Ticket (subject, description, priority, creationDate, creationTime, author) VALUES ('$subject', '$description', '$priority', '$creationDate', '$creationTime', '$author')");
}
else {
    $query = $db->prepare("INSERT INTO Ticket (subject, description, priority, creationDate, creationTime, author, department) VALUES ('$subject', '$description', $priority, '$creationDate', '$creationTime', '$author', '$department')");
}

if ($query == false){
    die("Query died");
}



$result = $query->execute();

if ($result === false){
    $errorInfo = $query->errorInfo();
    die("Query execution failed: " . $errorInfo[2]);
}

$ticketID = $db->lastInsertId();

$tags = trim($tags);
$tags = $tags == "" ? [] : explode(",", $tags);

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

header("Location: ../pages/ticket.php?ticket=$ticketID");

?>