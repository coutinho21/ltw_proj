<?php
    require_once(__DIR__ . '/../database/users.php');
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!getUserByEmail($email)){
        header('Location: ../pages/index.php?error=3');
        exit();
    }
    
    $user = userExists($email, $password);
    if(!$user){
        header('Location: ../pages/index.php?error=4');
        exit();
    }
        
    $_SESSION['username'] = $user['username'];
    header('Location: ../index.php');
?>