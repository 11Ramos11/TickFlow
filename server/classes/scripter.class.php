<?php

class Scripter {

    public $handlers = array();
    public $loader = null;

    public function __construct($loader = "default.js", $handlers = array("responsiveness.js", "snackbar.js")){
        $this->loader = "../scripts/$loader";

        foreach ($handlers as $handler){
            $this->handlers[] = "../scripts/handlers/$handler";
        }
    }

    public function loadScripts(){
       
        foreach ($this->handlers as $handler){ ?>
            <script src=<?=$handler?>></script>
        <?php } ?>
        <script src=<?=$this->loader?>></script> 
        <script src="../scripts/util.js"></script>
        <?php
    }
}

?>