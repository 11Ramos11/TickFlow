<?php

include_once(__DIR__.'/../classes/connection.db.php');

class Ticket {

    public $id, $subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID, $departmentID;

    function __construct($id, $subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID, $departmentID){
        $this->id = $id;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->tags = $tags;
        $this->date = $date;
        $this->time = $time;
        $this->authorID = $authorID;
        $this->assignedID = $assignedID;
        $this->departmentID = $departmentID;
    }

    static public function getTicketByID($ticketID){

        $db = getDatabaseConnection();
    
        $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID'");
        $query->execute();
        
        $results = $query->fetchAll();
    
        $result = $results[0];
    
        $tags = Ticket::getTagsById($result['id']);
    
        $ticket = new Ticket(
            $result['id'],
            $result['subject'], 
            $result['description'], 
            $result['status'], 
            $result['priority'], 
            $tags, 
            $result['creationDate'], 
            $result['creationTime'], 
            $result['author'], 
            $result['assignedTo'],
            $result['department']
        );
     
        return $ticket;
    }

    static public function getTagsById($id){

        $db = getDatabaseConnection();
    
        $query = $db->prepare("SELECT * FROM Ticket_Hashtag WHERE ticket = '$id'");
        $query->execute();
        
        $results = $query->fetchAll();
    
        $tags = array();
    
        foreach ($results as $row){
    
            $query = $db->prepare("SELECT * FROM Hashtag WHERE id = '$row[hashtag]'");
            $query->execute();
    
            $results = $query->fetchAll();
            $tag = $results[0]['name'];
    
            $tags[] = $tag;
        }
    
        return $tags;
    }
}

?>