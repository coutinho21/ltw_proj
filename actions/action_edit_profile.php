<?php
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../utilities/utilities.php');
    
    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $visiting = $_POST['visiting'];
    $username = cleanInput($_POST['user']);
    $newUsername = cleanInput($_POST['new_username']);
    $newName = cleanInput($_POST['new_name']);
    $newEmail = cleanInput($_POST['new_email']);
    $newRole = $_POST['new_role'];
    $departments = $_POST['departments'];
    $user = getUser($username);

    // clean departments
    $allDepartments = getDepartments();
    $newDepartments = array();
    foreach($departments as $department){
        foreach($allDepartments as $allDepartment){
            if($department == $allDepartment['name']){
                $newDepartments[] = $allDepartment['id'];
            }
        }
    }
    $departments = $newDepartments;

    if (!$visiting) {
        if($user['role'] == 'client'){
            updateUser($username, $newUsername, $newName, $newEmail);
        }
        else if($user['role'] != 'agent'){
            updateUserWithDepartments($username, $newUsername, $newName, $newEmail, $departments);
        }
        header('Location: ../pages/profile.php');
        exit();
    }

    if($user['role'] == 'client'){
        updateClientVisiting($username, $newUsername, $newName, $newEmail, $newRole);
    }
    else if($user['role'] == 'agent'){
        updateEveryField($username, $newUsername, $newName, $newEmail, $newRole, $departments);
    }
    header('Location: ../pages/profile.php?username=' . $newUsername);
?>