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
}

if (!isset($_POST['id'])) {
    header('Location: ../pages/dashboard.php');
}

$id = $_POST['id'];

$ticket = Ticket::getTicketById($id);

if ($ticket == null) {
    $session->setError('Ticket not found', 'The ticket you are trying to edit does not exist.');
    header('Location: ../pages/dashboard.php');
}

if (!isset($_POST['subject']) || !isset($_POST['description']) || !isset($_POST['priority']) || !isset($_POST['status']) || !isset($_POST['department'])) {
    $session->setError('Missing fields', 'Please fill all the required fields.');
    header('Location: ../pages/editTicket.php?ticket='.$id);
}

$subject = $_POST['subject'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$status = $_POST['status'];
$department = $_POST['department'];
$assignee = $_POST['assignee'];
$tags = $_POST['tags'];

error_log($subject);
error_log($description);
error_log($priority);
error_log($status);
error_log($department);
error_log($assignee);
error_log($tags);

if ($subject == '' || $description == '' || $priority == '' || $status == '' || $department == '') {
    $session->setError('Missing fields', 'Please fill all the required fields.');
    header('Location: ../pages/editTicket.php?ticket='.$id);
}

if ($assignee == '') {
    $assignee = null;
}

if ($tags == '') {
    $tags = null;
}

error_log($tags);

$tags = explode(',', $tags);

Ticket::updateTicket($id, $subject, $description, $priority, $status, $department, $assignee, $tags);

header('Location: ../pages/ticket.php?ticket='.$id);

