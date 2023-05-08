<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/profile.php');
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');

    $user = getUser($_SESSION['username']);
    outputHeader(); 
    outputChangePassword($user);
    outputFooter();
?>