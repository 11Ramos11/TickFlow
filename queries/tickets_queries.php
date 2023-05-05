<?php



function getTicketsForUser($userID){
    
    $db = new PDO('sqlite:database/database.db');
    
    $query = $db->prepare("SELECT * FROM Ticket WHERE author = '$userID'");
    $query->execute();
    
    $results = $query->fetchAll();

    $tickets = array();

    foreach ($results as $row){

        $tags = array("tag1", "tag2", "tag3");

        $tickets[] = new Ticket(
            $row['subject'], 
            $row['description'], 
            $row['status'], 
            $row['priority'], 
            $tags, 
            $row['date'], 
            $row['time'], 
            $row['author'], 
            $row['assigned']
        );
    }

    return $tickets;
}

?>