<?php
    function outputProfile($user){
?>
        <main class="profile-info">
            <div class="header-edit-profile">
                <h1>Profile</h1>
                <button onclick="window.location.href='edit_profile.php'">Edit profile</button>
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

    function outputEditProfile($user){
?>
    <main class="edit-profile">
        <h1>Edit profile</h1>
        <form class="edit-profile-form" method="post" action="../actions/action_edit_profile.php">
            <label>name<br/>
                <input value="<?=$user['name']?>"></input> <br/><br/>
            </label>
            <label>username<br/>
                <input value="<?=$user['username']?>"></input> <br/><br/>
            </label>
            <label>email<br/>
                <input value="<?=$user['email']?>"></input> <br/><br/>
            </label> 
            <div class="cancel-done">
                <button onclick="window.location.href='profile.php'">Cancel</button>
                <button type="submit">Done</button>
            </div>
        </form>
    </main>
<?php
    }
?>