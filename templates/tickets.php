<?php
    function outputTickets($tickets){
?>
        <div class="tickets-list">
            <ul>
<?php
            if(count($tickets) == 0)
                outputNoTickets();
            else{
                foreach($tickets as $ticket){
                    outputTicket($ticket);
                }
            }
?>
            </ul>
        </div>
<?php
    }

    function outputTicket($ticket){
?>  
        <li class="ticket">
            <ul>
                <li><p>#<?=$ticket['id']?></p></li>
                <li><p><?=$ticket['title']?></p></li>
                <li><p><?=date('d-m-Y', $ticket['date'])?></p></li>
                <li><p><?=$ticket['status']?></p></li>
            </ul>
        </li>   
<?php

    }

    function outputNoTickets(){
?>
    <h2>
        You have no tickets yet. <a href="new_ticket.php">Create one</a>.
    </h2>
<?php
    }
?>