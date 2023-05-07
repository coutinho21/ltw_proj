<?php
    function outputProfile($user){
?>
        <main class="profile-info">
            <div class="header-edit-profile">
                <h1>Profile</h1>
                <button>Edit profile</button>
            </div>
            <div>
                <label>name</label>
                <p><?=$user['name']?></p>
            </div>
            <div>
                <label>username</label>
                <p><?=$user['username']?></p>
            </div>
            <div>
                <label>email</label>
                <p><?=$user['email']?></p>
            </div>
            <div>
                <label>role</label>
                <p><?=$user['role']?></p>
            </div>
            <a href="../actions/action_logout.php" style="text-align: center; color: #000;">Logout</a>
        </main>
<?php
    }
?>