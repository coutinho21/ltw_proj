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

    $newDepartment = cleanInput($_POST['department-name']);

    newDepartment($newDepartment);
    header('Location: ../pages/index.php');
?>