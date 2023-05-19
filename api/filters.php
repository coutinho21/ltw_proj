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

    if($filter == 'date') {
        $from = strtotime(cleanInput($_GET['from']));
        $to = strtotime(cleanInput($_GET['to']));
        foreach ($tickets as $key => $ticket){
            if(($ticket['date'] > $to) || ($ticket['date'] < $from)){
                unset($tickets[$key]);
            }
        }
    }

    // re-format date before going to json
    $tickets = array_map(function($ticket){
        $ticket['date'] = date('d-m-Y', $ticket['date']);
        return $ticket;
    }, $tickets);

    echo json_encode($tickets);
?>