<?php
    function outputTickets($tickets, $statuses){
        ob_start();
?>
        <div class="tickets-list">
            <ul>
<?php
            if(count($tickets) == 0)
                outputNoTickets();
            else{
                foreach($tickets as $ticket){
                    $ticket['status'] = $statuses[$ticket['status_id'] - 1]['name'];
                    outputTicket($ticket);
                }
            }
?>
            </ul>
        </div>
<?php
        return ob_get_clean();
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

    function outputTicketDiscussion($ticket, $ticketHistory, $ticketHashtags, $ticketReplies, $statuses, $departments, $role){
        ob_start();
?>
        <div class="ticket-discussion">
            <a href="index.php"><img class="return" src="../icons/return.png" alt="return"/></a>
            <div class="ticket">
                <div class="ticket-header">
                    <div class="ticket-id-title">
                        <h1 id="ticket-id">#<?=$ticket['id']?></h1>
                        <h1><?=$ticket['title']?></h1>
                    </div>
<?php 
                    if($role == 'client'){ 
?>
                        <h1><?=$ticket['status']?></h1>
<?php               
                    } 
                    else { 
?>
                        <div class="ticket-manage-status-department">
                            <select id="ticket-status">
<?php 
                            foreach($statuses as $status){ 
                                if($status['name'] == $ticket['status']){
?>                                  
                                    <option selected value="<?=$status['id']?>"><?=$status['name']?></option>
<?php
                                }
                                else {
?>
                                    <option value="<?=$status['id']?>"><?=$status['name']?></option>
<?php
                                }
                            }
?>
                            </select>
                            <select id="ticket-department">
<?php 
                            foreach($departments as $department){ 
                                if($department['id'] == $ticket['department_id']){
?>                                  
                                    <option selected value="<?=$department['id']?>"><?=$department['name']?></option>
<?php
                                }
                                else {
?>
                                    <option value="<?=$department['id']?>"><?=$department['name']?></option>
<?php
                                }
                            }
?>
                            </select>
                        </div>
<?php 
                    } 
?>
                </div>
                <div class="hashtags">
                    <?php foreach($ticketHashtags as $hashtag){
                        outputHashtag($hashtag);
                    }
                    if($role != 'client'){
                    ?>
                    <button id="add-hashtag-button">Add hashtag</button>
                <?php } ?>
                </div>
                <div class="ticket-body">
                    <p><?=$ticket['introduction']?></p>
                    <p><?=$ticket['description']?></p>
                </div>
                <div class="ticket-footer">
                    <h4>Created by: <a href="../pages/profile.php?username=<?=$ticket['client']?>"><?=$ticket['client']?></a></h4>
                    <h4>Assigned to: <a id="assigned-agent" href="../pages/profile.php?username=<?=$ticket['agent']?>"><?=$ticket['agent']?></a></h4>
                </div>
            </div>
            <div class="ticket-replies">
<?php 
            foreach($ticketReplies as $reply){
                outputTicketReply($reply);
            }
            if($ticket['status'] != 'closed') {
?>
                <form action="../actions/action_ticket_reply.php" method="post" class="ticket-reply-form">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>"></input>
                    <input type="hidden" name="ticket_id" value="<?=$ticket['id']?>"/>
                    <textarea name="reply" placeholder="Reply to this ticket..."></textarea>
<?php
                    if($role != 'client'){
?>
                        <p id="answer-with-faq-button">Answer with FAQ</p>
<?php
                    }
?>
                    <button class="ticket-reply-post" type="submit">Reply</button>
                </form>
<?php
            }
?>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    function outputHashtag($hashtag){
?>
        <div class="hashtag">
            <p><?=$hashtag['name']?></p>
        </div>
<?php
    }

    function outputTicketReply($reply){
?>
        <div id="reply-<?=$reply['id']?>" class="ticket-reply">
            <div class="ticket-reply-header">
                <h4><a href="../pages/profile.php?username=<?=$reply['user']?>"><?=$reply['user']?></a></h4>
                <h4><?=date('d-m-Y', $reply['reply_date'])?></h4>
            </div>
            <div class="ticket-reply-body">
                <p><?=$reply['reply']?></p>
            </div>
        </div>
<?php
    }

    function outputNewTicket($departments){
        ob_start();
?>
        <div class="new-ticket">
            <h2>New ticket</h2>
            <form action="../actions/action_new_ticket.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>"></input>
                <div class="title-department">
                  <input type="text" name="title" placeholder="Title" required/>
                  <select name="department">
<?php
                      foreach($departments as $department){
?>
                          <option value="<?=$department['id']?>"><?=$department['name']?></option>
<?php
                      }
?>
                  </select>
                </div>
                <textarea id="introduction" name="introduction" placeholder="Introduction" required></textarea>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
                <button type="submit">Create</button>
            </form>
        </div>
<?php
        return ob_get_clean();
    }
?>