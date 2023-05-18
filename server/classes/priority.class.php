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

    static public function getPrioritiesArray(){

        $priorities = Priority::getPriorities();

        $prioritiesArray = array();

        foreach($priorities as $priority){
            $prioritiesArray[$priority->id] = $priority->name;
        }

        return $prioritiesArray;
    }

    static public function createPriority($name){

        $db = getDatabaseConnection();

        $query = $db->prepare("INSERT INTO Priority (name) VALUES (?)");

        $query->execute(array($name));
    }

    static public function editPriority($id, $name){

        $db = getDatabaseConnection();

        $query = $db->prepare("UPDATE Priority SET name = ? WHERE id = ?");

        $query->execute(array($name, $id));
    }

    static public function removePriority($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("DELETE FROM Priority WHERE id = $id");

        $query->execute();
    }
}