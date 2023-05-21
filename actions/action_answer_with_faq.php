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

    $ticket_id = cleanInput($_POST['ticketId']);
    $faq_id = cleanInput($_POST['faqId']);
    $username = $_SESSION['username'];
    $user = getUser($username);
    $ticket = getTicket($ticket_id);

    $reply = 'This question has already been answered, 
    please check out <a href="../pages/faqs.php#faq-' . $faq_id . '">this FAQ</a>';

    // only the agent that was assigned to this ticket
    // and admins can answer with a FAQ
    if($user['role'] == 'agent' && $ticket['agent'] != $username){
        header('Location: ../pages/ticket.php?error=6&id=' . $ticket_id);
        exit();
    }

    $reply_id = addTicketReply($ticket_id, $username, $reply, time());
    header('Location: ../pages/ticket.php?id=' . $ticket_id . '#reply-' . $reply_id);
?>