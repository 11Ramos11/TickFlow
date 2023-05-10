<?php

include_once('util.php');

function getUser($userID){

    $db = new PDO('sqlite:database/database.db');

    $query = $db->prepare("SELECT * FROM User WHERE id = '$userID'");
    $query->execute();
    
    $results = $query->fetchAll();

    if (count($results) == 0){
        return null;
    }

    $result = $results[0];

    $user = new User($result['id'], $result['name'], $result['email'], $result['role']);

    return $user;
}