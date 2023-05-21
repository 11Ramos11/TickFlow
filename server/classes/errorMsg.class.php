<?php

class ErrorMsg {
    public $code;
    public $msg;

    function __construct($code, $msg) {
        $this->code = $code;
        $this->msg = $msg;
    }
}

?>