<?php
    require_once(__DIR__ . '/../database/users.php');
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = userExists($email, $password);
    if($user)
        $_SESSION['username'] = $user['username'];

    header('Location: ../index.php');
?>