<?php 
    function outputHeader(){
?>
        <!DOCTYPE html>
        <html lang="en-US">

        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/homepage_client_style.css">
            <link rel="stylesheet" href="../css/ticket.css">
            <link rel="stylesheet" href="../css/profile.css">
            <script src="../javascript/script.js" defer></script>
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
<?php } 

    function outputAddSearchFilter($content){
?>
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
            <?=$content?>
        </main>
<?php
    }
?>