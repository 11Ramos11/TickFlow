<?php

include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/faq.class.php');

class Department {
    
    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    public function getFAQs(){
        
        return FAQ::getFAQsByDepartment($this->id);
    }

    public function getTicketsByStatus($status){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE department = ? AND status = ?");

        $query->execute(array($this->id, $status));

        $results = $query->fetchAll();

        return count($results);
    }

    public function getOpenTickets(){
        return $this->getTicketsByStatus("Open");
    }

    public function getPendingTickets(){
        return $this->getTicketsByStatus("Pending");
    }

    public function getClosedTickets(){
        return $this->getTicketsByStatus("Closed");
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