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

if (!isset($_POST['subject'])){
    $session->setError("No subject", "No subject was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['description'])){
    $session->setError("No description", "No description was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['priority'])){
    $session->setError("No priority", "No priority was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['tags'])){
    $session->setError("No tags", "No tags were provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (!isset($_POST['department'])){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

$subject = trim($_POST['subject']);
$description = trim($_POST['description']);
$priority = $_POST['priority'];
$tags = trim($_POST['tags']);
$author =  $user->id;
$creationDate = date("Y-m-d");
$creationTime = date("H:i:s");
$department = trim($_POST['department']);


if ($subject == ""){
    $session->setError("No subject", "No subject was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($description == ""){
    $session->setError("No description", "No description was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($priority == ""){
    $session->setError("No priority", "No priority was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($tags == ""){
    $session->setError("No tags", "No tags were provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if ($department == ""){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

if (strlen($subject) > 255){
    $session->setError("Subject too long", "The subject is too long.");
    header("Location: ../pages/ticketCreator.php");
    exit();
}

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