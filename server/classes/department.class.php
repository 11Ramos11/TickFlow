<?php

class Department {
    
    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    static function getDepartments(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Department");

        $query->execute();

        $departments = array();

        foreach($query as $row){
            $departments[] = new Department($row['id'], $row['name']);
        }

        return $departments;
    }

    static function getDepatmentByID($id){

        $db = getDatabaseConnection();
        
        $query = $db->prepare("SELECT * FROM Department WHERE id = '$id'");

        $query->execute();

        $results = $query->fetchAll();

        if (count($results) == 0){
            return null;
        }

        $result = $results[0];

        $department = new Department($result['id'], $result['name']);

        return $department;
    }
    
}

?>