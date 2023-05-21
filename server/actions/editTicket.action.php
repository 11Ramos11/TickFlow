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

if (!preg_match('/^[a-zA-Z0-9.,!?\s]+$/i', $subject)){
    $session->setError("Invalid input", "The subject contains invalid characters.");
    header("Location: ../pages/admin.php");
    exit();
}

if (!preg_match('/^[a-zA-Z0-9.,!?\s]+$/i', $description)){
    $session->setError("Invalid input", "The description contains invalid characters.");
    header("Location: ../pages/admin.php");
    exit();
}

if (!preg_match('/^[a-zA-Z0-9,\s]+$/i', $tags)){
    $session->setError("Invalid input", "The tags cannot contain special characters.");
    header("Location: ../pages/admin.php");
    exit();
}

if (!is_numeric($priority)) {
    $session->setError('Invalid input', 'The priority must be a number.');
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

    if (!is_numeric($status)){
        $session->setError("Invalid input", "The status cannot contain special characters.");
        header("Location: ../pages/admin.php");
        exit();
    }

    $ticket->updateStatus($status);
}

if (isset($_POST['assignee'])){

    if (!is_numeric($assignee)){
        $session->setError("Invalid input", "The assignee cannot contain special characters.");
        header("Location: ../pages/admin.php");
        exit();
    }

    $assignee = $_POST['assignee'];
    $ticket->updateAssignee($assignee);
}

if (isset($_POST['department'])){
    $department = $_POST['department'];

    if (!is_numeric($department)){
        $session->setError("Invalid input", "The department cannot contain special characters.");
        header("Location: ../pages/admin.php");
        exit();
    }

    $ticket->updateDepartment($department);
}

$newChanges = count($ticket->getChanges());

$numChanges = $newChanges - $oldChanges;

$authorID = $session->userID;

$ticket->updateChangeAuthor($authorID, $numChanges);

$session->setSuccess('Ticket updated', 'The ticket was successfully updated.');

header('Location: ../pages/ticket.php?ticket='.$id);

