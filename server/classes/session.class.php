<?php

declare(strict_types=1);

include_once(__DIR__.'/../classes/user.class.php');

class Session {

    public $userID;
    public $error;
    
    public function __construct() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->userID = null;
        $this->error = null;

        if (isset($_SESSION["userID"])) {

            $userID = $_SESSION["userID"];
            
            if (is_numeric($userID)){
                $this->userID = $_SESSION["userID"];
            } 
        } 

        if (isset($_SESSION["error"])){
            if ($_SESSION["error"] instanceof MyError){
                $this->error = $_SESSION["error"];
            }
        }
    }

    public function login(int $userID) {
        $_SESSION["userID"] = $userID;
        $this->userID = $userID;
    }

    public function logout() {
        unset($_SESSION["userID"]);
        $this->userID = null;
    }
    
    public function isLoggedIn() {

        return $this->userID != null;
    }

    public function getUser(){
        return User::getUserById($this->userID);
    }

    public function isAdmin() {
        return $this->isLoggedIn() && $this->getUser()->role == "Admin";
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