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

    $ticket = getAllTickets();

    // re-format date before going to json
    $tickets = array_map(function($ticket){
        $ticket['date'] = date('d-m-Y', $ticket['date']);
        return $ticket;
    }, $tickets);

    if($filter == 'date'){
            // re-format date to match the one in the database
            $from = cleanInput($_GET['from']);
            $to = cleanInput($_GET['to']);
            $from = date("d-m-Y", strtotime($from));
            $to = date("d-m-Y", strtotime($to));
            foreach ($tickets as $key => $ticket){
                if($ticket['date'] > $to || $ticket['date'] < $from){
                    unset($tickets[$key]);
                }
            }
    }

    echo json_encode($tickets);
?>