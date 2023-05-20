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

    $response = array();
    $dataType = cleanInput($_GET['data']);

    if($dataType == 'agents'){
        $data = getAgents();
    }
    else if($dataType == 'status'){
        $data = getStatuses();
    }

    foreach($data as $value){
        $response[] = $value;
    }

    echo json_encode($response);
?>