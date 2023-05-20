<?php

include_once(__DIR__.'/../classes/connection.db.php');

class FAQ {
    public $id;
    public $question;
    public $answer;

    function __construct($id, $question, $answer) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
    }

    static public function getFAQS(){
        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM FAQ");
        $query->execute();
        $results = $query->fetchAll();
        
        $faqs = array();

        foreach ($results as $row) {
            $faqs[] = new FAQ($row['id'], $row['question'], $row['answer']);
        }

        return $faqs;
    }

    static public function getFAQsByDepartment($departmentID){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM FAQ WHERE department = '$departmentID'");
        $query->execute();
        $results = $query->fetchAll();

        $faqs = array();

        foreach ($results as $row) {
            $faqs[] = new FAQ($row['id'], $row['question'], $row['answer']);
        }

        return $faqs;
    }
}

?>