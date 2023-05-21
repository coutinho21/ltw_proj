<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit();
    }

    $usersDepartments = getUsersDepartments();
    $ticketId = cleanInput($_POST['ticketId']);
    $departmentId = cleanInput($_POST['departmentId']);
    $agent = cleanInput($_POST['agent']);

    $flag = true;
    foreach ($usersDepartments as $userDepartment){
        if($userDepartment['department_id'] == $departmentId && $userDepartment['user'] == $agent){
            $flag = false;
        }
    }
    if($flag){
        updateStatusWithAgent($ticketId, NULL, 1);
    }

    updateTicketDepartment($ticketId, $departmentId);
    header('Location: ../pages/ticket.php?id=' . $ticketId);
?>