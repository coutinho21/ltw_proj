<?php
    require_once(__DIR__ . '/../database/users.php');
    
    session_start();

    var_dump($_SESSION);

    if (isset($_SESSION['username'])){
        header('Location: ../pages/register.php');
        exit();
    }

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confimPassword = $_POST['confirm_password'];

    if(strlen($password) < 8){
        header('Location: ../pages/register.php?error=5');
        exit();
    }

    if ($password != $confimPassword){
        header('Location: ../pages/register.php?error=1');
        exit();
    }

    if(userExists($email, $password)){
        header('Location: ../pages/register.php?error=2');
        exit();
    }

    addUser($name, $username, $email, $password);
    $_SESSION['username'] = $username;
    
    header('Location: ../pages/register.php');
?>