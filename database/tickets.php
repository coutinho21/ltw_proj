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

    function getTicketReplies($id){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM ticket_replies WHERE ticket_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function addTicketReply($ticket_id, $username, $reply){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO ticket_replies (ticket_id, user, reply, reply_date) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($ticket_id, $username, $reply, time()));
    }

    function getDepartments(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM departments');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function newDepartment($newDepartment){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO departments (name) VALUES (?)');
        $stmt->execute(array($newDepartment));
    }

    function newTicket($user, $department, $title, $introduction, $description){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO tickets (client, department_id, title, introduction, description, date, status_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($user, $department, $title, $introduction, $description, time(), 1));
        return $db->lastInsertId();
    }

    function searchTickets($search){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets WHERE title LIKE ?');
        $stmt->execute(array('%' . $search . '%'));
        return $stmt->fetchAll();
    }

    function getTicketsByDepartment($department){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT tickets.* FROM tickets 
                              JOIN departments 
                              ON tickets.department_id = departments.id
                              WHERE departments.name = ?');
        $stmt->execute(array($department));
        return $stmt->fetchAll();
    }

    function getStatuses(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM status');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getHashtags(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM hashtags');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getTicketsHashtags(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets_hashtags');
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>