<?php

include_once(__DIR__ . '/../classes/ticket.class.php');
include_once(__DIR__ . '/../classes/connection.db.php');

class User
{

    public $id, $name, $email, $role;

    public function __construct($id, $name, $email, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    public function getAuthoredTickets()
    {

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE author = '$this->id'");
        $query->execute();

        $results = $query->fetchAll();

        $tickets = array();

        foreach ($results as $row) {

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

    public function getAssignedTickets()
    {

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE assignedTo = '$this->id'");
        $query->execute();

        $results = $query->fetchAll();

        $tickets = array();

        foreach ($results as $row) {

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

    public function getAllTickets()
    {
        if ($this->isAdmin())
            return Ticket::getAllTickets();
        else if ($this->isAgent())
            return array_merge($this->getAuthoredTickets(), $this->getAssignedTickets());

        else if ($this->isClient())
            return $this->getAuthoredTickets();
        else
            return array();
    }

    public function isAdmin()
    {
        return $this->role == "Admin";
    }

    public function isAgent()
    {
        return $this->role == "Agent";
    }

    public function isClient()
    {
        return $this->role == "Client";
    }

    public function hasAccessToTicket($ticketID)
    {

        if ($this->isAdmin()) {
            error_log("IS ADMIN LETS GOOOO");
            return true;
        } else {
            error_log("ITS NOT ADDMIIN, lETS NOT GOT");
        }

        $userID = $this->id;

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID' AND (author = '$userID' OR assignedTo = '$userID')");
        $query->execute();

        $results = $query->fetchAll();

        return count($results) > 0;
    }

    static public function getUserById($userID)
    {

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM User WHERE id = '$userID'");
        $query->execute();

        $results = $query->fetchAll();

        if (count($results) == 0) {
            return null;
        }

        $result = $results[0];

        $user = new User($result['id'], $result['name'], $result['email'], $result['role']);

        return $user;
    }

    static public function getUsers(){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM User");
        $query->execute();

        $results = $query->fetchAll();

        $users = array();

        foreach ($results as $row) {

            $users[] = new User(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['role']
            );
        }

        return $users;
    }
}
