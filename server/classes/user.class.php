<?php

include_once(__DIR__.'/../classes/ticket.class.php');
include_once(__DIR__.'/../classes/connection.db.php');

class User {

    public $id, $name, $email, $role;

    public function __construct($id, $name, $email, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    public function getTickets(){

        $db = getDatabaseConnection();
    
        $query = $db->prepare("SELECT * FROM Ticket WHERE author = '$this->id'");
        $query->execute();
        
        $results = $query->fetchAll();

        $tickets = array();

        foreach ($results as $row){

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
                $row['assignedTo'],
                $row['department']
            );
        }

        return $tickets;
    }

    public function isAdmin(){
        return $this->role == "Admin";
    }

    public function hasAccessToTicket($ticketID){
        
        if ($this->isAdmin())
            return true;
        
        $userID = $this->id;

        $db = getDatabaseConnection();
        
        $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID' AND (author = '$userID' OR assignedTo = '$userID')");
        $query->execute();
        
        $results = $query->fetchAll();

        return count($results) > 0;
    }

    static public function getUserById($userID){

        $db = getDatabaseConnection();
    
        $query = $db->prepare("SELECT * FROM User WHERE id = '$userID'");
        $query->execute();
        
        $results = $query->fetchAll();
    
        if (count($results) == 0){
            return null;
        }
    
        $result = $results[0];
    
        $user = new User($result['id'], $result['name'], $result['email'], $result['role']);
    
        return $user;
    }

}

?>