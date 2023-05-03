<?php
    require_once(__DIR__ . '/../templates/common.php');

    session_start();

    if (isset($_SESSION['username'])) {
        outputHeader(); ?>
        <main style="display: flex; flex-direction: column; align-items: center;">
            <div>
                <h1>Welcome, <?=$_SESSION['username']?>!</h1>
            </div>
            <a href="../actions/action_logout.php">Logout</a>
        </main>
<?php   outputFooter();
    } else
        header('Location: ../index.php');
?>