<?php

include_once(__DIR__.'/../classes/connection.db.php');

class Change {

    public $fieldChanged, $newValue, $oldValue, $editDate, $editTime, $ticketID;

    public function __construct($fieldChanged, $newValue, $oldValue, $editDate, $editTime, $ticketID){
        $this->fieldChanged = $fieldChanged;
        $this->newValue = $newValue;
        $this->oldValue = $oldValue;
        $this->editDate = $editDate;
        $this->editTime = $editTime;
        $this->ticketID = $ticketID;            
    }

    public function getTicket(){
        return Ticket::getTicketByID($this->ticketID);
    }

    static public function getRecentChanges(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Change ORDER BY editDate DESC, editTime DESC LIMIT 10");

        $query->execute();

        $results = $query->fetchAll();

        $changes = array();

        foreach ($results as $row) {
            $changes[] = new Change(
                $row['fieldChanged'], 
                $row['newValue'], 
                $row['oldValue'], 
                $row['editDate'], 
                $row['editTime'],
                $row['ticket']
            );
        }

        return $changes;
    }
}