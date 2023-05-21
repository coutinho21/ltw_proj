<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $newDepartment = cleanInput($_POST['department-name']);

    newDepartment($newDepartment);
    header('Location: ../pages/index.php');
?>