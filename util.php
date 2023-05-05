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

    public $subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID;

    function __construct($subject, $description, $status, $priority, $tags, $date, $time, $authorID, $assignedID){
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
?>