<?php 
    function outputHeader(){
        session_start();
?>
        <!DOCTYPE html>
        <html lang="en-US">

        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/styles.css">
            <link rel="stylesheet" href="css/homepage_client_style.css">
        </head>

        <body>
            <header>
                <nav>
                    <ul>
                        <li><a href="index.php">Trouble <br /> Tickets</a></li>
                        <li><h2>FAQs</h2></li>
                        <li><img class="profile" src="icons/user.png" alt="user"/></li>
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
<?php } ?>