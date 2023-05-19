<?php
include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/status.class.php');
include_once(__DIR__.'/../classes/priority.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: ../pages/authentication.php');
}

if (!isset($_POST['userId'])) {
    return null;
}

// convert $_POST['userId'] to integer
$userID = intval($_POST['userId']);

error_log($_POST['userId']);
error_log($userID);

$user = User::getUserById($userID);

if ($user == null) {
    return null;
}

$sessionUser = $session->getUser();

if ($user->id != $sessionUser->id && $sessionUser->role != 'Admin') {
    return null;
}

if (!isset($_POST['ownership'])){
    return null;
}

$ownership = $_POST['ownership'];

if ($ownership == 'Assigned'){
    $tickets = $user->getAssignedTickets();
} else if ($ownership == 'Author'){
    $tickets = $user->getAuthoredTickets();
} else if ($ownership == 'All'){
    if ($id === $session->userID) {
        $tickets = $user->getAllTickets();
    } else {
        $tickets = array_merge($user->getAuthoredTickets(), $user->getAssignedTickets());
    }
} else if ($ownership == 'Others' && $user->role == 'Admin'){
    $tickets = Ticket::getAllTickets();
    $tickets = array_filter($tickets, function($ticket) use ($user){
        return $ticket->authorID != $user->id && $ticket->assignedID != $user->id;
    });
}

if (!isset($_POST['status']) || !isset($_POST['priority']) || !isset($_POST['department']) || !isset($_POST['tags'])){
    return null;
}

$status = $_POST['status'];
$priority = $_POST['priority'];
$departmentID = $_POST['department'];
$tags = $_POST['tags'];
$tagList = $tags != '' ? explode(',', $tags) : [];

$filteredTickets = array();

foreach($tickets as $ticket){
    if ($ticket->matches($status, $priority, $departmentID, $tagList)){
        $filteredTickets[] = $ticket;
    }
}

$statuses = Status::getStatusesArray();
$priorities = Priority::getPrioritiesArray();

$result = array("tickets" => $filteredTickets, "statuses" => $statuses, "priorities" => $priorities, "isAdmin" => $user->isAdmin());

echo json_encode($result);

?>