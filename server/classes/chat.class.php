<?php

class Message {

    public $id, $content, $date, $time, $author, $ticket, $authorName, $authorPhoto, $authorID;

    public function __construct($id, $content, $date, $time, $author, $ticket){
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->time = $time;
        $this->author = $author;
        $this->ticket = $ticket;

        $userAuthor = User::getUserByID($author);
        $this->authorName = $userAuthor->name;
        $this->authorPhoto = $userAuthor->getPhoto();
        $this->authorID = $userAuthor->id;
    }

    public function belongsToUser($user){
        return $user->id == $this->author;
    }
}

class Chat {

    public $ticketID, $messages;

    public function __construct($ticketID){
        $this->ticketID = $ticketID;
        $this->messages = array();
    }

    public function getMessages(){
        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Message WHERE ticket = ? ORDER BY creationDate, creationTime");

        $query->execute(array($this->ticketID));

        $results = $query->fetchAll();

        $messages = array();

        foreach ($results as $row) {
            $messages[] = new Message(
                $row['id'], 
                $row['content'], 
                $row['creationDate'], 
                $row['creationTime'], 
                $row['author'], 
                $row['ticket']
            );
        }

        return $messages;
    }

    public function addMessage($content, $author){
        $db = getDatabaseConnection();

        $creationDate = date("Y-m-d");
        $creationTime = date("H:i:s");

        $query = $db->prepare("INSERT INTO Message (content, creationDate, creationTime, author, ticket) VALUES (?, ?, ?, ?, ?)");

        $query->execute(array($content, $creationDate, $creationTime, $author, $this->ticketID));
    }

    static public function getChatByTicketID($ticketID){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Chat WHERE ticket = :ticket");

        $query->execute(array(
            ':ticket' => $ticketID
        ));

        $results = $query->fetchAll();

        if (count($results) == 0){
            $query = $db->prepare("INSERT INTO Chat (ticket) VALUES (:ticket)");

            $query->execute(array(
                ':ticket' => $ticketID
            ));

            $query = $db->prepare("SELECT * FROM Chat WHERE ticket = :ticket");

            $query->execute(array(
                ':ticket' => $ticketID
            ));

            $results = $query->fetchAll();
        }

        $chat = new Chat(
            $results[0]['id'], 
            $results[0]['ticket']
        );

        return $chat;
    }
}

?>