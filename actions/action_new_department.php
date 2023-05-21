<?php
    require_once(__DIR__ . '/../database/tickets.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $newDepartment = $_POST['department-name'];

    newDepartment($newDepartment);
    header('Location: ../pages/index.php');
?>