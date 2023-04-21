<?php
    require_once('connection.php');

    function userExists($username, $password){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->execute(array($username));
        $hashedPassword = $stmt->fetch();
        return password_verify($password, $hashedPassword['password']);
    }
?>