<?php
    require_once(__DIR__ . '/../database/faqs.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $id = $_GET['id'];

    deleteFAQ($id);
    header('Location: ../pages/faqs.php');
?>