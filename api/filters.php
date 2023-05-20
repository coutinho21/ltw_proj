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
    else if($filter == 'hashtag'){
        $hashtag = cleanInput($_GET['hashtag']);
        $ticketsHashtags = getTicketsHashtags();
        foreach ($tickets as $ticket){
            foreach ($ticketsHashtags as $ticketHashtag){
                if(($ticket['id'] == $ticketHashtag['ticket_id']) && ($ticketHashtag['hashtag_id'] == $hashtag)){
                    $response[] = $ticket;
                }
            }
        }
    }

    // re-format date before going to json
    $response = array_map(function($ticket){
        $statuses = getStatuses();
        $ticket['date'] = date('d-m-Y', $ticket['date']);
        $ticket['status'] = $statuses[$ticket['status_id'] - 1]['name'];
        return $ticket;
    }, $response);

    echo json_encode($response);
