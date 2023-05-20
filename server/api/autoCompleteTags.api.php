<?php 

include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header('Location: ../pages/authentication.php');
}

$db = getDatabaseConnection();

$query = $db->prepare('SELECT * FROM Hashtag');
$query->execute();
$results = $query->fetchAll();

$tags = array();

foreach($results as $result){
    $tags[] = $result['name'];
}

echo json_encode($tags);
