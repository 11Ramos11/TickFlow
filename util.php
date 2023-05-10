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

    public $id, $name, $email, $role;

    function __construct($id, $name, $email, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
}

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
}

class Department {
    
    public $id, $name;

    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}
?>