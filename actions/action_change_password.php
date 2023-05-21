<?php
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $visiting = $_POST['visiting'];
    $email = $_POST['user_email'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_new_password'];
    $username = $_POST['user'];

    if(!loginUser($email, $currentPassword)){
        if($visiting){
            header('Location: ../pages/change_password.php?error=4&username=' . $username);
            exit();
        }
        else{
            header('Location: ../pages/change_password.php?error=4');
            exit();
        }
    }

    if($newPassword != $confirmPassword){
        if($visiting){
            header('Location: ../pages/change_password.php?error=1&username=' . $username);
            exit();
        }
        else{
            header('Location: ../pages/change_password.php?error=1');
            exit();
        }
    }

    if(strlen($newPassword) < 8){
        if($visiting) {
            header('Location: ../pages/change_password.php?error=5&username=' . $username);
            exit();
        }
        else {
            header('Location: ../pages/change_password.php?error=5');
            exit();
        }
    }

    changeUserPassword($email, $newPassword);
    if($visiting)
        header('Location: ../pages/profile.php?username=' . $username);
    else
        header('Location: ../pages/profile.php');
?>