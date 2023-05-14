<?php
include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/user.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: ../pages/authentication.php');
}

$user = $session->user;

$tickets = $user->getTickets();

$ownership = $_POST['ownership'];
$status = $_POST['status'];
$priority = $_POST['priority'];
$departmentID = $_POST['department'];
$tags = $_POST['tags'];
$tagList = $tags != '' ? explode(',', $tags) : [];

$filteredTickets = array();

error_log("Ownership:".$ownership);

foreach($tickets as $ticket){
    if ($ticket->matches($status, $priority, $departmentID, $tagList)){
        $filteredTickets[] = $ticket;
    }
}

echo json_encode($filteredTickets);

?>