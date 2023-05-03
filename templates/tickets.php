<?php
    function outputTickets($tickets){
?>
        <div class="tickets-list">
            <ul>
<?php
            foreach($tickets as $ticket){
                outputTicket($ticket);
            }
?>
            </ul>
        </div>
<?php
    }

    function outputTicket($ticket){
?>  
        <li>
            <ul>
                <li><p>#<?=$ticket['id']?></p></li>
                <li><p><?=$ticket['title']?></p></li>
                <li><p><?=date('d-m-Y', $ticket['date'])?></p></li>
                <li><p><?=$ticket['status']?></p></li>
            </ul>
        </li>   
<?php

    }
?>