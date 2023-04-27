<?php
    require_once('connection.php');

    function userExists($email, $password){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();
        if(password_verify($password, $user['password']))
            return $user;
        return false;
    }

    function addUser($name, $username, $email, $password){
        $options = ['cost' => 10];
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $username, $email, password_hash($password, PASSWORD_BCRYPT, $options), "client"));
    }
?>