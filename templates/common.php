<?php 
    function outputHeader(){
?>
        <!DOCTYPE html>
        <html lang="en-US">

        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" href="../icons/ticket.png" type="image/png" sizes="16x16">
            <link rel="stylesheet" href="../css/homepage_client_style.css">
            <link rel="stylesheet" href="../css/ticket.css">
            <link rel="stylesheet" href="../css/profile.css">
            <link rel="stylesheet" href="../css/new_ticket.css">
            <script src="../javascript/script.js" defer></script>
            <script src="../errors/errors.js" defer></script>
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><a class="main-title" href="index.php">Trouble<br/>Tickets</a></li>
                        <li>
                            <div class="nav-right">
                                <a href="faqs.php">FAQs</a>
                                <a href="profile.php"><img class="profile" src="../icons/user.png" alt="user"/></a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>
<?php 
    } 

    function outputFooter(){ ?>
            <footer>
                <p>&copy; Trouble Tickets, 2023</p>
            </footer>
        </body>
        </html>
<?php 
    } 

    function outputAddSearchFilter($content, $departments){
?>
        <nav class="add-and-search">
            <a href="../pages/new_ticket.php">New ticket</a>
            <input name="search_ticket" placeholder="Search ticket" class="search-ticket"/>
        </nav>
        <main class="main-content">
            <div class="filter">
                <ul class="departments">
                    <?php foreach($departments as $department){ ?>
                        <li><p><?=$department['name']?></p></li>
                    <?php } ?>
                </ul>
            </div>
            <?=$content?>
        </main>
<?php
    }
?>