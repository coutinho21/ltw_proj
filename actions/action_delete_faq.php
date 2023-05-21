<?php
    require_once(__DIR__ . '/../database/faqs.php');
    require_once(__DIR__ . '/../utilities/utilities.php');
    
    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $id = cleanInput($_GET['id']);

    deleteFAQ($id);
    header('Location: ../pages/faqs.php');
?>