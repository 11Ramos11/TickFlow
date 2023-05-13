<?php

class MyError {
    public $code;
    public $msg;

    function __construct($code, $msg) {
        $this->code = $code;
        $this->msg = $msg;
    }

    function draw($code){

        if ($this->code == $code){
            echo "<p id=".$this->code."-error class='error'> $this->msg </p>";
        }
    }
}

?>