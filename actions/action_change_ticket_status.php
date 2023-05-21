<?php
    require_once(__DIR__ . '/../database/tickets.php');
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

    $ticketId = cleanInput($_POST['ticketId']);
    $statusId = cleanInput($_POST['statusId']);

    if ($statusId == '1') {
        updateStatusWithAgent($ticketId, NULL, $statusId);
    }
    else if ($statusId == '2') {
        $agent = cleanInput($_POST['assignedAgent']);
        updateStatusWithAgent($ticketId, $agent, $statusId);
    }
    else if ($statusId == '3') {
        updateStatus($ticketId, $statusId);
    }

    header('Location: ../pages/ticket.php?id=' . $ticketId);
