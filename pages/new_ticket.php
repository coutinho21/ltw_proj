<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');

    session_start();

    $departments = getDepartments();
    $user = getUser($_SESSION['username']);

    outputHeader();
    outputAddSearchFilter(outputNewTicket($departments), $departments, $user['role']);
    outputFooter();
?>