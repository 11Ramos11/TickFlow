<?php

include_once(__DIR__.'/../classes/connection.db.php');

class FAQ {
    public $id;
    public $question;
    public $answer;
    public $department;

    function __construct($id, $question, $answer, $department) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->department = $department;
    }

    static public function getFAQS(){
        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM FAQ");
        $query->execute();
        $results = $query->fetchAll();
        
        $faqs = array();

        foreach ($results as $row) {
            $faqs[] = new FAQ($row['id'], $row['question'], $row['answer'], $row['department']);
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
            $faqs[] = new FAQ($row['id'], $row['question'], $row['answer'], $row['department']);
        }

        return $faqs;
    }

    static public function removeFAQ($id){
        $db = getDatabaseConnection();

        $query = $db->prepare("DELETE FROM FAQ WHERE id = '$id'");
        $query->execute();
    }

    static public function createFAQ($question, $answer, $department){
        $db = getDatabaseConnection();

        $query = $db->prepare("INSERT INTO FAQ (question, answer, department) VALUES (?,?,?)");
        
        $query->execute(array($question, $answer, $department));

        return $db->lastInsertId();
    }

    static public function editFAQ($id, $question, $answer, $department){

        $db = getDatabaseConnection();

        $query = $db->prepare("UPDATE FAQ SET question = '$question', answer = '$answer', department = '$department' WHERE id = '$id'");
        $query->execute();
    }

    static public function getFAQbyID($id){

        $db = getDatabaseConnection();

        $query = $db->prepare("SELECT * FROM FAQ WHERE id = '$id'");
        $query->execute();
        $results = $query->fetchAll();

        $row = $results[0];

        $faq = new FAQ($row['id'], $row['question'], $row['answer'], $row['department']);

        return $faq;
    }
}

?>