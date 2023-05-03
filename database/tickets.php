<?php
    require_once('connection.php');
    function getAllTickets() {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>