<?php
    session_start();
    require_once('database/users.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (userExists($username, $password))
        $_SESSION['username'] = $username;

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>