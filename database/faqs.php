<?php
    require_once('connection.php');

    function getFAQs(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM faqs');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>