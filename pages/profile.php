<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/profile.php');
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');


    outputHeader(); 

    $username = $_SESSION['username'];
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }

    if ($username == $_SESSION['username']) {
        $user = getUser($username);
        outputProfile($user);
    }
    else {
        $user = getUser($username);
        outputUserProfile($user);
    }
    
    outputFooter();
?>