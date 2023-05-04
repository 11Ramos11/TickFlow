<?php

$db->new SQLite3('../database/database.db');

$departments = array(
    'Sales Department'                      => 1,
    'Marketing Department'                  => 2,
    'Information Technology Department'     => 3,
    'Human Resources Department'            => 4,
);

function getTicketsForDeparment($department) {
    $results = $db->query("SELECT * FROM Ticket WHERE department == $departments[$department]");

    $tickets = array();

    while ($ticket = $results->fetchArray()){
        $tickets[] = $ticket;
    }

    return $tickets;
}

department.php?name=xpto
?>