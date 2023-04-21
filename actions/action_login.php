<?php
    session_start();
    require_once('database/users.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (userExists($username, $password))             // test if user exists
        $_SESSION['username'] = $username;            // store the username

    header('Location: ' . $_SERVER['HTTP_REFERER']);  // redirect to the page we came from
?>