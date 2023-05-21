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

    $username = $_SESSION['username'];
    $department = cleanInput($_POST['department']);
    $title = cleanInput($_POST['title']);
    $introduction = cleanInput($_POST['introduction']);
    $description = cleanInput($_POST['description']);

    $ticket_id = newTicket($username, $department, $title, $introduction, $description);
    header('Location: ../pages/ticket.php?id=' . $ticket_id);
?>