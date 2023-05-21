<?php

include_once(__DIR__.'/../classes/connection.db.php');

class Change {

    public $fieldChanged, $newValue, $oldValue, $editDate, $editTime, $ticketID, $author;

    public function __construct($fieldChanged, $newValue, $oldValue, $editDate, $editTime, $ticketID, $author){
        $this->fieldChanged = $fieldChanged;
        $this->newValue = $newValue;
        $this->oldValue = $oldValue;
        $this->editDate = $editDate;
        $this->editTime = $editTime;
        $this->ticketID = $ticketID;            
        $this->author = $author;
    }

    public function getTicket(){
        return Ticket::getTicketByID($this->ticketID);
    }

    static public function getRecentChanges($userID){

        $db = getDatabaseConnection();

        $user = User::getUserByID($userID);

        if (!$user->isAdmin()){
            $query = $db->prepare("SELECT * FROM Change WHERE ticket IN (SELECT id FROM Ticket WHERE author = ? OR assignee = ?) ORDER BY editDate DESC, editTime DESC LIMIT 10");
            $query->execute(array($userID, $userID));
        }
        else {
            $query = $db->prepare("SELECT * FROM Change ORDER BY editDate DESC, editTime DESC LIMIT 10");
            $query->execute();
        }

        $results = $query->fetchAll();

        $changes = array();

        foreach ($results as $row) {
            $changes[] = new Change(
                $row['fieldChanged'], 
                $row['newValue'], 
                $row['oldValue'], 
                $row['editDate'], 
                $row['editTime'],
                $row['ticket'],
                $row['author']
            );
        }

        return $changes;
    }
}