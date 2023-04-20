<?php 
    require_once('templates/common.php');

    if(!isset($_SESSION['user'])){
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
        <div class="main main-register">
            <div class="main-text">
                <a href="index.php">Trouble<br/>Tickets</a>
                <h2>We're here to help!<br/>Submit your tickets today.</h2>
                <img src="icons/ticket.png" alt="">
            </div>
            <form action="ticket.php" method="post">
                <p>Sign up</p>
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm password" required>
                <button type="submit">Sign up</button>
            </form>
        </div>
    </body>
</html>

<?php
    } else 
        header('Location: index.php');
?>