<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/profile.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../database/tickets.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');


    outputHeader(); 

    $user = getUser($_SESSION['username']);

    $username = $_SESSION['username'];
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }


    // viewing own profile
    if ($username == $_SESSION['username']) {
        if($user['role'] != 'client'){
            $departments = getDepartments();
            $usersDepartments = getUsersDepartments();
            $user['departments'] = array();
            foreach($usersDepartments as $usersDepartment){
                if($usersDepartment['user'] == $user['username']){
                    $user['departments'][] = $departments[$usersDepartment['department_id'] - 1]['name'];
                }
            }
        }
        outputProfile($user, false);
    }
    // viewing other profile
    else {
        $userToVisit = getUser($username);

        // get departments for agents and admins
        if($user['role'] != 'client'){
            $departments = getDepartments();
            $usersDepartments = getUsersDepartments();
            $user['departments'] = array();
            $userToVisit['departments'] = array();
            foreach($usersDepartments as $usersDepartment){
                if($usersDepartment['user'] == $user['username']){
                    $user['departments'][] = $departments[$usersDepartment['department_id'] - 1]['name'];
                }
                if($usersDepartment['user'] == $userToVisit['username']){
                    $userToVisit['departments'][] = $departments[$usersDepartment['department_id'] - 1]['name'];
                }
            }
        }

        if($user['role'] == 'admin' && $userToVisit['role'] != 'admin'){
            outputProfile($userToVisit, true);
        }
        else {
            outputUserProfile($userToVisit);
        }
    }
    
    outputFooter();
?>