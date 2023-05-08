<?php

include_once("util.php");

function getDepartments(){

    $db = new PDO('sqlite:database/database.db');

    $query = $db->prepare("SELECT * FROM Department");

    $query->execute();

    $departments = array();

    foreach($query as $row){
        $departments[] = new Department($row['id'], $row['name']);
    }

    return $departments;
}

function getDepartmentByID($departmentID){

    $db = new PDO('sqlite:database/database.db');

    $query = $db->prepare("SELECT * FROM Department WHERE id = '$departmentID'");

    $query->execute();

    $results = $query->fetchAll();

    if (count($results) == 0){
        return null;
    }

    $result = $results[0];

    $department = new Department($result['id'], $result['name']);

    return $department;
}
