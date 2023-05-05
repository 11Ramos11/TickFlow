<?php

$db->new SQLite3('../database/database.db');

$departments = array(
    'Sales Department'                      => 1,
    'Marketing Department'                  => 2,
    'Information Technology Department'     => 3,
    'Human Resources Department'            => 4,
);

function getFAQOfDeparment($department) {
    $results = $db->query("SELECT * FROM FAQ WHERE department == $departments[$department]");

    $FAQs = array();

    while ($FAQ = $results->fetchArray()){
        $FAQs[] = $FAQ;
    }

    return $FAQs;
}
?>