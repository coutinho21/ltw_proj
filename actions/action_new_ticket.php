<?php
    require_once(__DIR__ . '/../database/tickets.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $username = $_SESSION['username'];
    $department = $_POST['department'];
    $title = $_POST['title'];
    $introduction = $_POST['introduction'];
    $description = $_POST['description'];

    $ticket_id = newTicket($username, $department, $title, $introduction, $description);
    header('Location: ../pages/ticket.php?id=' . $ticket_id)
?>