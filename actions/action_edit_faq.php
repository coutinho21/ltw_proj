<?php
    require_once(__DIR__ . '/../database/faqs.php');
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

    $id = cleanInput($_POST['id']);
    $question = cleanInput($_POST['question']);
    $answer = cleanInput($_POST['answer']);

    updateFAQ($id, $question, $answer);
    header('Location: ../pages/faqs.php');
?>