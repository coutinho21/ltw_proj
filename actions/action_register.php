<?php
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if (isset($_SESSION['username'])){
        header('Location: ../pages/register.php');
        exit();
    }

    $name = cleanInput($_POST['name']);
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $confimPassword = cleanInput($_POST['confirm_password']);

    
    if(getUserByEmail($email)){
        header('Location: ../pages/register.php?error=2');
        exit();
    }

    if(strlen($password) < 8){
        header('Location: ../pages/register.php?error=5');
        exit();
    }

    if ($password != $confimPassword){
        header('Location: ../pages/register.php?error=1');
        exit();
    }

    addUser($name, $username, $email, $password);
    $_SESSION['username'] = $username;
    
    header('Location: ../pages/register.php');
?>
