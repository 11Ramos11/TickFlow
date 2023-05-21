<?php

class SuccessMsg {
    public $code;
    public $msg;

    function __construct($code, $msg) {
        $this->code = $code;
        $this->msg = $msg;
    }
}

?>