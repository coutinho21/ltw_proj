<?php 
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/no_user.php');
    session_start();

    if (isset($_SESSION['username']))
        header('Location: ../index.php');
    else outputRegister();
?>