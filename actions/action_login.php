<?php
    session_start();
    require_once(__DIR__ . '/../database/users.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = userExists($email, $password);
    if($user)
        $_SESSION['username'] = $user['username'];

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>