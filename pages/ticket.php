<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');
    

    $ticket = getTicket($_GET['id']);
    $ticketHistory = getTicketHistory($_GET['id']);
    $ticketHashtags = getTicketHashtags($_GET['id']);
    $ticketReplies = getTicketReplies($_GET['id']);
    $departments = getDepartments();

    outputHeader();
    outputAddSearchFilter(outputTicketDiscussion($ticket, $ticketHistory, $ticketHashtags, $ticketReplies), $departments);
    outputFooter();
?>