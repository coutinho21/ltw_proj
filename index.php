<?php 
    require_once('templates/common.php');

    if (!gisset($_SESSION['user'])) {     // if user is not logged in
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Trouble Tickets</title>
        <meta charset="UTF-8">
        <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="main">
            <div class="main-text">
                <a href="index.php">Trouble<br/>Tickets</a>
                <h2>We're here to help!<br/>Submit your tickets today.</h2>
                <img src="icons/ticket.png" alt="ticket">
            </div>
            <form action="ticket.php" method="post">
                <p>Welcome!</p>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="register.php">Sign up</a></p>
            </form>
        </div>
    </body>
</html>

<?php
    } else {                // if user is logged in, go to the main page
        outputHeader(); ?>
        <nav class="add-and-search">
            <h2>New ticket</h2>
            <input type="search_ticket" name="search_ticket" placeholder="Search ticket">
        </nav>
        <main class="main-content">
            <div class="departments">
                <p>All tickets</p>
                <ul>
                    <li><p>Department 1</p></li>
                    <li><p>Department 2</p></li>
                    <li><p>Department 3</p></li>
                    <li><p>Department 4</p></li>
                </ul>
            </div>
            <div class="tickets-list">
                <ul>
                    <li>
                        <ul>
                            <li><p>#0001</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0002</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0003</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0004</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0005</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0006</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0007</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0008</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0009</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><p>#0010</p></li>
                            <li><p>This is the title of this ticket</p></li>
                            <li><p>date of last update</p></li>
                            <li><p>status</p></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </main>
    <?php outputFooter();
    }
?>