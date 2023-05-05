<?php

$db->new SQLite3('../database/database.db');

$departments = array(
    'Sales Department'                      => 1,
    'Marketing Department'                  => 2,
    'Information Technology Department'     => 3,
    'Human Resources Department'            => 4,
);

function getUsersOfDeparment($department) {
    $results = $db->query("SELECT * FROM User WHERE department == $departments[$department]");

    $users = array();

    while ($user = $results->fetchArray()){
        $users[] = $user;
    }

    return $users;
}
?>