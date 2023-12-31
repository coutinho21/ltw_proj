<?php
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../utilities/utilities.php');

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: ../pages/index.php');
        exit();
    }

    $department = cleanInput($_GET['department']);
    $tickets = getTicketsByDepartment($department);
    $user = getUser($_SESSION['username']);
    $response = array();

    if($user['role'] == 'client'){
        foreach ($tickets as $ticket){
            if($ticket['client'] != $user['username']){
                continue;
            }
            $response[] = $ticket;
        }
    }
    else {
        $response = $tickets;
    }

    // re-format date and add status before going to json
    $response = array_map(function($ticket){
        $statuses = getStatuses();
        $ticket['date'] = date('d-m-Y', $ticket['date']);
        $ticket['status'] = $statuses[$ticket['status_id'] - 1]['name'];
        return $ticket;
    }, $response);

    echo json_encode($response);
?>