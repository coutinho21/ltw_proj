<?php
function outputLogin(){
?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/login.css">
            <script src="../errors/errors.js" defer></script>
        </head>
        <body>
            <div class="main">
                <div class="main-text">
                    <a href="index.php">Trouble<br/>Tickets</a>
                    <h2>We're here to help!<br/>Submit your tickets today.</h2>
                    <img src="../icons/ticket.png" alt="ticket">
                </div>
                <form action="../actions/action_login.php" method="post">
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
}

function outputRegister(){
?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/register.css">
            <script src="../errors/errors.js" defer></script>
        </head>
        <body>
            <div class="main main-register">
                <div class="main-text">
                    <a href="index.php">Trouble<br/>Tickets</a>
                    <h2>We're here to help!<br/>Submit your tickets today.</h2>
                    <img src="../icons/ticket.png" alt="">
                </div>
                <form action="../actions/action_register.php" method="post">
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
}
?>