<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');

    session_start();

    $departments = getDepartments();

    outputHeader();
    outputAddSearchFilter(outputNewTicket($departments));
    outputFooter();
?>