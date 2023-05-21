<?php

include_once(__DIR__.'/../classes/department.class.php');
include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()){
    error_log("not logged in");
    exit();
}

$sessionUser = $session->getUser();

if (!$sessionUser->isAgent()){

    error_log("not agent");
    exit();
}

if (!isset($_POST["department"])){
    error_log("no department");
    exit();
}

$departmentId = $_POST["department"];

$department = Department::getDepatmentByID($departmentId);

if ($department == null){
    echo json_encode(array());
    exit();
}

$users = $department->getUsers();

echo json_encode($users);