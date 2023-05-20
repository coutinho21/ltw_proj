<?php
    require_once(__DIR__ . '/../database/users.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $visiting = $_POST['visiting'];
    $username = $_POST['user'];
    $newUsername = $_POST['new_username'];
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];

    updateUser($username, $newUsername, $newName, $newEmail);
    if($visiting == 'true')
        header('Location: ../pages/profile.php?username=' . $newUsername);
    else
        header('Location: ../pages/profile.php');
?>