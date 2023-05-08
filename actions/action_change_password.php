<?php
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    }


    $email = $_POST['user_email'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_new_password'];

    if(!loginUser($email, $currentPassword)){
        header('Location: ../pages/change_password.php?error=4');
        exit();
    }

    if($newPassword != $confirmPassword){
        header('Location: ../pages/change_password.php?error=1');
        exit();
    }

    if(strlen($newPassword) < 8){
        header('Location: ../pages/change_password.php?error=5');
        exit();
    }

    changeUserPassword($email, $newPassword);
    header('Location: ../pages/profile.php');
?>