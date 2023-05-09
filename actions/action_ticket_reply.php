<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    }

    $ticket_id = $_POST['ticket_id'];
    $username = $_POST['user'];
    $reply = $_POST['reply'];

    $user = getUser($username);
    $ticket = getTicket($ticket_id);

    // only the client that created this ticket, the agent that was assigned
    // to it and admins can add comments to the discussion
    if(($user['role'] == 'client' && $ticket['client'] != $username)
        || ($user['role'] == 'agent' && $ticket['agent'] != $username)){
        header('Location: ../pages/ticket.php?id=' . $ticket);
        exit();
    }

    addTicketReply($ticket_id, $username, $reply, time());
    header('Location: ../pages/ticket.php?id=' . $ticket_id)
?>