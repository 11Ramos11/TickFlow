<?php

include_once(__DIR__.'/../classes/session.class.php');
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/status.class.php');
include_once(__DIR__.'/../classes/priority.class.php');
include_once(__DIR__.'/../classes/department.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: ../pages/authentication.php');
    exit();
}

if (!isset($_POST['id'])) {
    $session->setError('Missing fields', 'Please fill all the required fields.');
    header('Location: ../pages/dashboard.php');
    exit();
}

$id = $_POST['id'];

$ticket = Ticket::getTicketById($id);

if ($ticket == null) {
    $session->setError('Ticket not found', 'The ticket you are trying to edit does not exist.');
    header('Location: ../pages/dashboard.php');
    exit();
}

if (!isset($_POST['subject']) || !isset($_POST['description']) || !isset($_POST['priority'])) {
    $session->setError('Missing fields', 'Please fill all the required fields.');
    header('Location: ../pages/editTicket.php?ticket='.$id);
    exit();
}

$subject = $_POST['subject'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$tags = $_POST['tags'];

if ($subject == '' || $description == '' || $priority == '') {
    $session->setError('Missing fields', 'Please fill all the required fields.');
    header('Location: ../pages/editTicket.php?ticket='.$id);
    exit();
}

if ($tags == '') {
    $tags = null;
}

$tags = explode(',', $tags);

$ticket = Ticket::getTicketById($id);

$oldChanges = count($ticket->getChanges());

$ticket->updateTicket($subject, $description, $priority, $tags);

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $ticket->updateStatus($status);
}

if (isset($_POST['assignee'])){
    $assignee = $_POST['assignee'];
    $ticket->updateAssignee($assignee);
}

if (isset($_POST['department'])){
    $department = $_POST['department'];
    $ticket->updateDepartment($department);
}

$newChanges = count($ticket->getChanges());

$numChanges = $newChanges - $oldChanges;

$authorID = $session->userID;

$ticket->updateChangeAuthor($authorID, $numChanges);

$session->setSuccess('Ticket updated', 'The ticket was successfully updated.');

header('Location: ../pages/ticket.php?ticket='.$id);

