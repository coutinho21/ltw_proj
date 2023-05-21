<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/profile.php');
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    $user = getUser($_SESSION['username']);
    $visiting = false;
    if (isset($_GET['username'])) {
        $user = getUser($_GET['username']);
        $visiting = true;
    }

    outputHeader(); 
    outputChangePassword($user, $visiting);
    outputFooter();
?>