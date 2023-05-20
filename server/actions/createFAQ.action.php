<?php

include_once(__DIR__.'/../classes/user.class.php'); 
include_once(__DIR__.'/../classes/session.class.php'); 
include_once(__DIR__.'/../classes/department.class.php'); 
include_once(__DIR__.'/../classes/status.class.php'); 
include_once(__DIR__.'/../classes/priority.class.php'); 
include_once(__DIR__.'/../classes/my_error.class.php'); 
include_once(__DIR__.'/../classes/connection.db.php');

$session = new Session();

if (!$session->isLoggedIn()){
    header("Location: ../pages/authentication.php");
    exit();
}

if (!$session->getUser()->isAgent()){
    $session->setError("No permissions", "You do not have permissions to remove this FAQ.");
    header("Location: ../pages/index.php");
    exit();
}

if (!isset($_POST["question"])){
    $session->setError("No question", "No question was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

if (!isset($_POST["answer"])){
    $session->setError("No answer", "No answer was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

if (!isset($_POST["department"])){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

$question = trim($_POST["question"]);
$answer = trim($_POST["answer"]);
$department = $_POST["department"];

if ($question == ""){
    $session->setError("No question", "No question was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

if (strlen($question) > 255){
    $session->setError("Question too long", "The question is too long.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

if ($answer == ""){
    $session->setError("No answer", "No answer was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

if ($department == -1){
    $session->setError("No department", "No department was provided.");
    header("Location: ../pages/faqCreator.php");
    exit();
}

FAQ::createFAQ($question, $answer, $department);

header("Location: ../pages/home.php");
?>
