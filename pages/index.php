<?php 
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../database/users.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/tickets.php');
    require_once(__DIR__ . '/../templates/no_user.php');
    session_start();

    if (!isset($_SESSION['username']))     // if user is not logged in
        outputLogin();
    else {                                 // if user is logged in, go to the main page
        $user = getUser($_SESSION['username']);
        if ($user['role'] == 'client')
            $tickets = getUserTickets($_SESSION['username']);
        else 
            $tickets = getAllTickets();

        outputHeader(); ?>
        <nav class="add-and-search">
            <h2>New ticket</h2>
            <input type="search_ticket" name="search_ticket" placeholder="Search ticket">
        </nav>
        <main class="main-content">
            <div class="filter">
                <p>All tickets</p>
                <ul>
                    <li><p>Department 1</p></li>
                    <li><p>Department 2</p></li>
                    <li><p>Department 3</p></li>
                    <li><p>Department 4</p></li>
                </ul>
            </div>
            <?php
                outputTickets($tickets);
            ?>
        </main>
    <?php outputFooter();
    }
?>