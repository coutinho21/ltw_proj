<?php
    require_once('connection.php');

    function userExists($username, $password){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->execute(array($username));
        $hashedPassword = $stmt->fetch();
        return password_verify($password, $hashedPassword['password']);
    }

    function addUser($name, $username, $email, $password){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $username, $email, password_hash($password, PASSWORD_BCRYPT), "client"));
    }
?>