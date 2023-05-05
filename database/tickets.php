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

    function getTicketHistory($id){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM ticket_history WHERE ticket_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getTicketHashtags($id){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM hashtags JOIN tickets_hashtags 
        ON hashtags.id = tickets_hashtags.hashtag_id WHERE tickets_hashtags.ticket_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
?>