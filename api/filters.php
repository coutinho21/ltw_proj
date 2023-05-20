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

    $filter = cleanInput($_GET['filter']);
    $tickets = getAllTickets();
    $response = array();

    if($filter == 'date') {
        $from = strtotime(cleanInput($_GET['from']));
        $to = strtotime(cleanInput($_GET['to']));
        foreach ($tickets as $ticket){
            if(($ticket['date'] > $to) || ($ticket['date'] < $from)){
                continue;
            }
            $response[] = $ticket;
        }
    }
    else if($filter == 'agent') {
        $agent = cleanInput($_GET['agent']);
        foreach ($tickets as $ticket){
            if($ticket['agent'] != $agent){
                continue;
            }
            $response[] = $ticket;
        }
    }
    else if($filter == 'status') {
        $status = cleanInput($_GET['status']);
        foreach ($tickets as $ticket){
            if($ticket['status_id'] != $status){
                continue;
            }
            $response[] = $ticket;
        }
    }

    // re-format date before going to json
    $response = array_map(function($ticket){
        $ticket['date'] = date('d-m-Y', $ticket['date']);
        return $ticket;
    }, $response);

    echo json_encode($response);
?>