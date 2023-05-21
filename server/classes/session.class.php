<?php

declare(strict_types=1);

include_once(__DIR__.'/../classes/user.class.php');
include_once(__DIR__.'/../classes/errorMsg.class.php');
include_once(__DIR__.'/../classes/successMsg.class.php');

class Session {

    public $userID;
    public $error;
    public $success;
    public $token;
    
    public function __construct() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->userID = null;
        $this->error = null;
        $this->success = null;
        $this->token = null;

        if (isset($_SESSION["userID"])) {

            $userID = $_SESSION["userID"];
            
            if (is_numeric($userID)){
                $this->userID = $_SESSION["userID"];
            } 
        } 

        if (isset($_SESSION["error"])){
            if ($_SESSION["error"] instanceof ErrorMsg){
                $this->error = $_SESSION["error"];
            }
        }

        if (isset($_SESSION["success"])){
            if ($_SESSION["success"] instanceof SuccessMsg){
                $this->success = $_SESSION["success"];
            }
        }

        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = $this->generate_random_token();
        }
        $this->token = $_SESSION['csrf'];
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

        $this->unsetSuccess();
        
        $error = new ErrorMsg($code, $msg);
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

    public function setSuccess($code, $msg) {

        $this->unsetError();

        $success = new SuccessMsg($code, $msg);
        $_SESSION["success"] = $success;
        $this->success = $success;
    }

    public function getSuccess() {
        if (isset($_SESSION["success"])) {
            $this->success = $_SESSION["success"];
            unset($_SESSION["success"]);
            return $this->success;
        }
        return null;
    }

    public function hasSuccess() {
        return $this->success != null;
    }

    public function unsetSuccess() {
        unset($_SESSION["success"]);
    }

    public function tokenMatches($token) {
        return $token === $this->token;
    }

    private function generate_random_token() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
}


?>