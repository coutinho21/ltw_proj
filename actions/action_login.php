<?php
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');
    
    session_start();

    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    
    if(!getUserByEmail($email)){
        header('Location: ../pages/index.php?error=3');
        exit();
    }
    
    $user = loginUser($email, $password);
    if(!$user){
        header('Location: ../pages/index.php?error=4');
        exit();
    }
        
    $_SESSION['username'] = $user['username'];
    $_SESSION['csrf'] = generateToken();
    header('Location: ../index.php');
?>