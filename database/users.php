<?php
    require_once('connection.php');

    function loginUser($email, $password){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute(array($email));
        $user = $stmt->fetch();
        if(password_verify($password, $user['password']))
            return $user;
        return false;
    }

    function getUser($username){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getUserByEmail($email){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute(array($email));
        return $stmt->fetch();
    }

    function addUser($name, $username, $email, $password){
        $options = ['cost' => 10];
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $username, $email, password_hash($password, PASSWORD_BCRYPT, $options), "client"));
    }
    
    function getUserTickets($username){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM tickets WHERE client = ?');
        $stmt->execute(array($username));
        return $stmt->fetchAll();
    }

    function updateUser($username, $newUsername, $newName, $newEmail){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE users SET username = ?, name = ?, email = ? WHERE username = ?');
        $stmt->execute(array($newUsername, $newName, $newEmail, $username));
    }

    function updateClientVisiting($username, $newUsername, $newName, $newEmail, $newRole){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE users SET username = ?, name = ?, email = ?, role = ? WHERE username = ?');
        $stmt->execute(array($newUsername, $newName, $newEmail, $newRole, $username));
    }

    function updateUserWithDepartments($username, $newUsername, $newName, $newEmail, $departments){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE users SET username = ?, name = ?, email = ? WHERE username = ?');
        $stmt->execute(array($newUsername, $newName, $newEmail, $username));
        $stmt = $db->prepare('DELETE FROM users_departments WHERE user = ?');
        $stmt->execute(array($newUsername));
        foreach($departments as $department){
            $stmt = $db->prepare('INSERT INTO users_departments (user, department_id) VALUES (?, ?)');
            $stmt->execute(array($newUsername, $department));
        }
    }

    function updateEveryField($username, $newUsername, $newName, $newEmail, $newRole, $departments){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE users SET username = ?, name = ?, email = ?, role = ? WHERE username = ?');
        $stmt->execute(array($newUsername, $newName, $newEmail, $newRole, $username));
        $stmt = $db->prepare('DELETE FROM users_departments WHERE user = ?');
        $stmt->execute(array($newUsername));
        foreach($departments as $department){
            $stmt = $db->prepare('INSERT INTO users_departments (user, department_id) VALUES (?, ?)');
            $stmt->execute(array($newUsername, $department));
        }
    }

    function changeUserPassword($email, $newPassword){
        $options = ['cost' => 10];
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
        $stmt->execute(array(password_hash($newPassword, PASSWORD_BCRYPT, $options), $email));
    }

    function getAgents(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE role = ? OR role = ?');
        $stmt->execute(array('agent', 'admin'));
        return $stmt->fetchAll();
    }

    function getUsersDepartments(){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT * FROM users_departments');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updateUsername($username, $newUsername){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE tickets SET client = ? WHERE client = ?');
        $stmt->execute(array($newUsername, $username));
        $stmt = $db->prepare('UPDATE tickets SET agent = ? WHERE agent = ?');
        $stmt->execute(array($newUsername, $username));
        $stmt = $db->prepare('UPDATE users_departments SET user = ? WHERE user = ?');
        $stmt->execute(array($newUsername, $username));
        $stmt = $db->prepare('UPDATE ticket_replies SET user = ? WHERE user = ?');
        $stmt->execute(array($newUsername, $username));
    }
?>