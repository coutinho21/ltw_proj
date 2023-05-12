<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../database/faqs.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');
    require_once(__DIR__ . '/../templates/faqs.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');
    
    $faqs = getFAQs();

    outputHeader();
    outputFAQs($faqs);
    outputFooter();
?>