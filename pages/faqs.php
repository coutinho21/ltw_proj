<?php
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../database/faqs.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/faqs.php');

    session_start();

    if(!isset($_SESSION['username']))
        header('Location: index.php');
    
    $user = getUser($_SESSION['username']);
    $faqs = getFAQs();

    outputHeader();
    outputFAQs($faqs, $user['role']);
    outputFooter();
?>