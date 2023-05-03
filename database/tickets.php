<?php
    require_once('connection.php');
    function getAllTickets() {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getTicket($id) {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
?>