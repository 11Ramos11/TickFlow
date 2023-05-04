<?php

class MyError {
    public $page;
    public $msg;

    function __construct($page, $msg) {
        $this->page = $page;
        $this->msg = $msg;
    }
}
?>