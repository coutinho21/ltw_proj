<?php
    require_once('database/connection.php');
    require_once('database/users.php');
    require_once('templates/common.php');
    
    session_start();

    if (isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    }

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confimPassword = $_POST['confirm_password'];

    if(strlen($password) < 8){
        header('Location: register.php?error=5');
        exit();
    }

    if ($password != $confimPassword){
        header('Location: register.php?error=1');
        exit();
    }

    if(userExists($username, $password)){
        header('Location: register.php?error=2');
        exit();
    }

    addUser($name, $username, $email, $password);
    $_SESSION['username'] = $username;
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>