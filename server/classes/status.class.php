<?php

include_once("../classes/connection.db.php");

class Status {

    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    static public function getStatusById($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Status WHERE id = $id");

        $query->execute();

        $results = $query->fetchAll();

        $result = $results[0];
        
        return new Status($result['id'], $result['name']);
    }


    static public function getStatuses(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Status");

        $query->execute();

        $results = $query->fetchAll();

        $statuses = array();

        foreach($results as $row){
            $statuses[] = new Status(
                $row['id'],
                $row['name']
            );
        }

        return $statuses;
    }
}