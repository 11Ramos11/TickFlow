<?php

include_once(__DIR__.'/../classes/connection.db.php');
include_once(__DIR__.'/../classes/faq.class.php');
include_once(__DIR__.'/../classes/status.class.php');

class Department {
    
    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }

    public function getFAQs(){
        
        return FAQ::getFAQsByDepartment($this->id);
    }

    public function getTicketsByStatus($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE department = ? AND status = ?");

        $query->execute(array($this->id, $id));

        $results = $query->fetchAll();

        return count($results);
    }

    public function getOpenTickets(){
        return $this->getTicketsByStatus("Open");
    }

    public function getPendingTickets(){
        return $this->getTicketsByStatus("Unassigned");
    }

    public function getClosedTickets(){
        return $this->getTicketsByStatus("Closed");
    }

    public function getTickets(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE department = ?");

        $query->execute(array($this->id));

        $results = $query->fetchAll();

        $tickets = array();

        foreach($results as $row){

            $tags = Ticket::getTagsById($row['id']);

            $tickets[] = new Ticket(
                $row['id'],
                $row['subject'],
                $row['description'],
                $row['status'],
                $row['priority'],
                $tags,
                $row['creationDate'],
                $row['creationTime'],
                $row['author'],
                $row['assignee'],
                $row['department']
            );
        }

        return $tickets;
    }

    public function getUsers(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM User WHERE department = ?");

        $query->execute(array($this->id));

        $results = $query->fetchAll();

        $users = array();

        foreach($results as $row){
            $users[] = new User($row['id'], $row['name'], $row['email'], $row['role'], $row['department']);
        }

        return $users;
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
        
        $query = $db->prepare("SELECT * FROM Department WHERE id = ?");

        $query->execute(array($id));

        $results = $query->fetchAll();

        if (count($results) == 0){
            return null;
        }

        $result = $results[0];

        $department = new Department($result['id'], $result['name']);

        return $department;
    }

    static public function createDepartment($name){

        $db = getDatabaseConnection();

        $query = $db->prepare("INSERT INTO Department (name) VALUES (?)");

        $query->execute(array($name));
    }
    
    static public function editDepartment($id, $name){

        $db = getDatabaseConnection();

        $query = $db->prepare("UPDATE Department SET name = ? WHERE id = ?");

        $query->execute(array($name, $id));
    }

    static public function removeDepartment($departmentID){

        $db = getDatabaseConnection();

        $query = $db->prepare("DELETE FROM Department WHERE id = ?");

        $query->execute(array($departmentID));
    }
}

?>