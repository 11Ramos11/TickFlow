<?php

include_once(__DIR__ . '/../classes/ticket.class.php');
include_once(__DIR__ . '/../classes/connection.db.php');

class User
{

    public $id, $name, $email, $role, $department;

    public function __construct($id, $name, $email, $role, $department)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->department = $department;
    }

    public function getAuthoredTickets(){

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
                $row['assignee'],
                $row['department']
            );
        }

        return $tickets;
    }

    public function getAssignedTickets()
    {

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE assignee = '$this->id'");
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
        if ($this->isAdmin()){
            return Ticket::getAllTickets();
        }
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
        return $this->role == "Agent" || $this->isAdmin();
    }

    public function isClient()
    {
        return $this->role == "Client";
    }

    public function hasAccessToTicket($ticketID)
    {

        if ($this->isAdmin()) {
            return true;
        }

        $userID = $this->id;

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM Ticket WHERE id = '$ticketID' AND (author = '$userID' OR assignee = '$userID')");
        $query->execute();

        $results = $query->fetchAll();

        return count($results) > 0;
    }

    public function isAuthorOf(Ticket $ticket){
        return $ticket->authorID == $this->id;
    }

    public function isAssignedTo(Ticket $ticket){
        return $ticket->assigneeID == $this->id;
    } 

    public function getPhoto(){
        $path = "../images/profiles/".$this->id.".png";
        if (file_exists($path)){
            return $path;
        }
        else {
            $path = "../images/profiles/".$this->id.".jpg";
            if (file_exists($path)){
                return $path;
            } else {
                $path = "../images/profiles/".$this->id.".gif";
                if (file_exists($path)){
                    return $path;
                }
                else {
                    $path = "../images/profiles/".$this->id.".jpeg";
                    if (file_exists($path)){
                        return $path;
                    }
                }
            }
        }

        return "../images/default.png";
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

        $user = new User($result['id'], $result['name'], $result['email'], $result['role'], $result['department']);

        return $user;
    }

    static public function getAllUsers(){

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
                $row['role'],
                $row['department']
            );
        }

        return $users;
    }

    static public function getUserByRole($role){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM User WHERE role = '$role'");
        $query->execute();

        $results = $query->fetchAll();

        $users = array();

        foreach ($results as $row) {

            $users[] = new User(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['role'],
                $row['department']
            );
        }

        return $users;
    }

    static public function getAdmins(){

        return User::getUserByRole("Admin");
    }

    static public function getAgents(){

        return User::getUserByRole("Agent");
    }

    static public function getClients(){

        return User::getUserByRole("Client");
    }
}
