<?php 
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');
    require_once(__DIR__ . '/../templates/no_user.php');
    
    session_start();

    if (!isset($_SESSION['username']))     // if user is not logged in
        outputLogin();
    else {                                 // if user is logged in, go to the main page
        $user = getUser($_SESSION['username']);
        if ($user['role'] == 'client')
            $tickets = getUserTickets($_SESSION['username']);
        else 
            $tickets = getAllTickets();

        $departments = getDepartments();
        $statuses = getStatuses();
            
        outputHeader(); 
        outputAddSearchFilter(outputTickets($tickets, $statuses), $departments, $user['role']);
        outputFooter();
    }
?>