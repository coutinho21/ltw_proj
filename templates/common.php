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
        </head>

        <body>
            <header>
                <h1>Trouble Tickets</h1>
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