<?php

class MyError {
    public $page;
    public $msg;

    function __construct($page, $msg) {
        $this->page = $page;
        $this->msg = $msg;
    }
}

class User {

    public $email, $name, $role, $id;

    function __construct($email, $name, $role, $id) {
        $this->email = $email;
        $this->name = $name;
        $this->role = $role;
        $this->id = $id;
    }
}

class Ticket {

    public $id, $subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID;

    function __construct($id, $subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID){
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
    }
}

class Department {
    
    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}
?>