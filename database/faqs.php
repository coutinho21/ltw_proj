<?php
    require_once('connection.php');

    function getFAQs(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM faqs');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function newFAQ($question, $answer) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO faqs (question, answer) VALUES (?, ?)');
        $stmt->execute(array($question, $answer));
    }
    
    function deleteFAQ($id) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('DELETE FROM faqs WHERE id = ?');
        $stmt->execute(array($id));
    }

    function updateFAQ($id, $question, $answer) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE faqs SET question = ?, answer = ? WHERE id = ?');
        $stmt->execute(array($question, $answer, $id));
    }
?>