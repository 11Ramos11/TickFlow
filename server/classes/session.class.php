<?php

declare(strict_types=1);

include_once(__DIR__.'/../classes/user.class.php');

class Session {

    public $user;
    public $error;
    
    public function __construct() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->user = null;
        $this->error = null;

        if (isset($_SESSION["user"])) {

            $user = $_SESSION["user"];
            
            if ($user instanceof User){
                $this->user = $_SESSION["user"];
            } 
        } 

        if (isset($_SESSION["error"])){
            if ($_SESSION["error"] instanceof MyError){
                $this->error = $_SESSION["error"];
            }
        }
    }

    public function login(User $user) {
        $_SESSION["user"] = $user;
        $this->user = $user;
    }

    public function logout() {
        unset($_SESSION["user"]);
        $this->user = null;
    }
    
    public function isLoggedIn() {

        return $this->user != null;
    }

    public function isAdmin() {
        return $this->isLoggedIn() && $this->user->role == "admin";
    }

    public function setError($code, $msg) {

        $error = new MyError($code, $msg);
        $_SESSION["error"] = $error;
        $this->error = $error;
    }

    public function getError() {
        if (isset($_SESSION["error"])) {
            $this->error = $_SESSION["error"];
            unset($_SESSION["error"]);
            return $this->error;
        }
        return null;
    }

    public function hasError() {
        return $this->error != null;
    }

    public function unsetError() {
        unset($_SESSION["error"]);
    }
}


?>