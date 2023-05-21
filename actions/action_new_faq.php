<?php
    require_once(__DIR__ . '/../database/faqs.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $question = $_POST['question'];
    $answer = $_POST['answer'];

    newFAQ($question, $answer);
    header('Location: ../pages/faqs.php');
?>