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

    static public function getStatusesArray(){

        $statuses = Status::getStatuses();

        $statusesArray = array();

        foreach($statuses as $status){
            $statusesArray[$status->id] = $status->name;
        }

        return $statusesArray;
    }

    static public function createStatus($name){

        $db = getDatabaseConnection();

        $query = $db->prepare("INSERT INTO Status (name) VALUES (?)");

        $query->execute(array($name));
    }

    static public function editStatus($id, $name){

        $db = getDatabaseConnection();

        $query = $db->prepare("UPDATE Status SET name = ? WHERE id = ?");

        $query->execute(array($name, $id));
    }

    static public function removeStatus($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("DELETE FROM Status WHERE id = ?");

        $query->execute(array($id));
    }

    static public function getStatusID($name){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Status WHERE name = ?");

        $query->execute(array($name));

        $results = $query->fetchAll();

        return count($results) > 0 ? $results[0]['id'] : null;
    }
}