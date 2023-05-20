<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/profile.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../database/tickets.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
        exit();
    }

    // check if user is visiting another profile or his own
    $user = getUser($_SESSION['username']);
    $visiting = false;
    if(isset($_GET['username'])){
        $user = getUser($_GET['username']);
        $visiting = true;
    }

    $departments = getDepartments();
    $usersDepartments = getUsersDepartments();

    // get departments for agents and admins
    if($user['role'] != 'client'){
        $user['departments'] = array();
        foreach($usersDepartments as $usersDepartment){
            if($usersDepartment['user'] == $user['username']){
                $user['departments'][] = $departments[$usersDepartment['department_id'] - 1]['name'];
            }
        }
    }

    outputHeader(); 
    outputEditProfile($user, $visiting);
    outputFooter();
?>