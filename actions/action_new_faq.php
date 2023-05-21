<?php
    require_once(__DIR__ . '/../database/faqs.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $question = cleanInput($_POST['question']);
    $answer = cleanInput($_POST['answer']);

    newFAQ($question, $answer);
    header('Location: ../pages/faqs.php');
?>