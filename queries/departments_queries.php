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

