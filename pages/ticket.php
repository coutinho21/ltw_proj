<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');

    session_start();

    $ticket = getTicket($_GET['id']);
    $ticketStatuses = getTicketStatuses($_GET['id']);
    outputHeader();
    outputAddSearchFilter(outputTicketDiscussion($ticket, $ticketStatuses));
    outputFooter();
?>