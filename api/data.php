<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $user = getUser($_SESSION['username']);

    if($user['role'] == 'client'){
        header('Location: ../pages/index.php');
        exit();
    }

    $dataType = cleanInput($_GET['data']);

    if($dataType == 'agents'){
        $data = getAgents();
    }
    else if($dataType == 'statuses'){
        $data = getStatuses();
    }
    else if ($dataType == 'hashtags') {
        $data = getHashtags();
    }
    else if ($dataType == 'departments'){
        $data = getDepartments();
    }

    echo json_encode($data);
