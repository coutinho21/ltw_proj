<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit();
    }

    $ticket_id = $_POST['ticket_id'];
    $username = $_SESSION['username'];
    $reply = cleanInput($_POST['reply']);

    $user = getUser($username);
    $ticket = getTicket($ticket_id);

    // only the client that created this ticket, the agent that was assigned
    // to it and admins can add comments to the discussion
    if(($user['role'] == 'client' && $ticket['client'] != $username)
        || ($user['role'] == 'agent' && $ticket['agent'] != $username)){
        header('Location: ../pages/ticket.php?error=6&id=' . $ticket_id);
        exit();
    }

    $reply_id = addTicketReply($ticket_id, $username, $reply, time());
    header('Location: ../pages/ticket.php?id=' . $ticket_id . '#reply-' . $reply_id);
?>