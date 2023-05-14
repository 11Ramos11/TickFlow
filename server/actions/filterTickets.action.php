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

if (isset($_GET['department'])){
    $departmentID = $_GET['department'];
    if ($departmentID != "all"){
        if ($departmentID == "none"){
            $tickets = Ticket::filterByDepartment($tickets, null);
        } else {
            $tickets = Ticket::filterByDepartment($tickets, $departmentID);
        }
    }
}

echo json_encode($tickets);

?>