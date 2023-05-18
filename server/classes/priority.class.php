<?php

include_once("../classes/connection.db.php");

class Priority {

    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    static public function getPriorityById($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Priority WHERE id = $id");

        $query->execute();

        $results = $query->fetchAll();

        $result = $results[0];
        
        return new Priority($result['id'], $result['name']);
    }

    static public function getPriorities(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Priority");

        $query->execute();

        $results = $query->fetchAll();

        $priorities = array();

        foreach($results as $row){
            $priorities[] = new Priority(
                $row['id'],
                $row['name']
            );
        }

        return $priorities;
    }
}