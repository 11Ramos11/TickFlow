<?php

function userHasAccessToTicket($ticketID){

    $role = $_SESSION["user"]->role;

    error_log("id: " . $_SESSION["user"]->id);
    error_log("ticketID: " . $ticketID);

    if ($role == "admin")
        return true;
    
    $userID = $_SESSION["user"]->id;

    $db = new PDO('sqlite:database/database.db');
    
    $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID' AND (author = '$userID' OR assignedTo = '$userID')");
    $query->execute();
    
    $results = $query->fetchAll();

    return count($results) > 0;
}

function getTicketTags($ticketID){

    $db = new PDO('sqlite:database/database.db');
    
    $query = $db->prepare("SELECT * FROM Ticket_Hashtag WHERE ticket = '$ticketID'");
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

function getTicket($ticketID){

    $db = new PDO('sqlite:database/database.db');

    $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID'");
    $query->execute();
    
    $results = $query->fetchAll();

    $result = $results[0];

    $tags = getTicketTags($result['id']);

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
        $result['assignedTo']
    );
 
    return $ticket;
}

function getTicketsForUser($userID){
    
    $db = new PDO('sqlite:database/database.db');
    
    $query = $db->prepare("SELECT * FROM Ticket WHERE author = '$userID'");
    $query->execute();
    
    $results = $query->fetchAll();

    $tickets = array();

    foreach ($results as $row){

        $tags = getTicketTags($row['id']);

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
            $row['assignedTo']
        );
    }

    return $tickets;
}

?>