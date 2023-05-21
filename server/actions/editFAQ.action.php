<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/department.class.php'); 
include_once(__DIR__.'/../classes/status.class.php'); 
include_once(__DIR__.'/../classes/priority.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: ../pages/authentication.php");
    exit();
}

if (!isset($_POST['csrf'])){
    $session->setError("Missing arguments","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

if ($_POST['csrf'] !== $session->token){
    $session->setError("Unauthorized","Refresh and try again");
    header("Location: ../pages/dashboard.php");
    exit();
}

if (!$session->getUser()->isAgent()){
    $session->setError("No permissions", "You do not have permissions to remove this FAQ");
    header("Location: ../pages/index.php");
    exit();
}

if (!isset($_POST["id"])){
    $session->setError("No id", "No id was provided");
    header("Location: ../pages/home.php");
    exit();
}

$id = $_POST["id"];

if (!isset($_POST["question"])){
    $session->setError("No question", "No question was provided");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

if (!isset($_POST["answer"])){
    $session->setError("No answer", "No answer was provided");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

if (!isset($_POST["department"])){
    $session->setError("No department", "No department was provided");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

$question = trim($_POST["question"]);
$answer = trim($_POST["answer"]);
$department = $_POST["department"];

if ($question == ""){
    $session->setError("No question", "No question was provided");
    header("Location: ../pages/faqEditor.php?id=$id");

    exit();
}

if (strlen($question) > 255){
    $session->setError("Question too long", "The question is too long");
    header("Location: ../pages/faqEditor.php?id=$id");

    exit();
}

if ($answer == ""){
    $session->setError("No answer", "No answer was provided");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

if ($department == -1){
    $session->setError("No department", "No department was provided");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

if (!preg_match('/^[a-zA-Z0-9.,!?\s]+$/i', $question)){
    
    $session->setError("Invalid question", "The question contains invalid characters");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

error_log($question);

if (!preg_match('/^[a-zA-Z0-9.,!?\s]+$/i', $answer)){
    $session->setError("Invalid question", "The question contains invalid characters");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

if (!is_numeric($department)){
    $session->setError("Invalid department", "The department is invalid");
    header("Location: ../pages/faqEditor.php?id=$id");
    exit();
}

FAQ::editFAQ($id, $question, $answer, $department);

$session->setSuccess("FAQ edited", "The FAQ was successfully edited");

header("Location: ../pages/home.php");
?>
