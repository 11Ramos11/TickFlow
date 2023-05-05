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

    public $email, $name, $role;

    function __construct($email, $name, $role) {
        $this->email = $email;
        $this->name = $name;
        $this->role = $role;
    }
}
?>