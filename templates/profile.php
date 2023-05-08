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
            <div class="change-pass-logout">
                <a href="change_password.php">Change password</a>
                <a href="../actions/action_logout.php">Logout</a>
            </div>
        </main>
<?php
    }

    function outputEditProfile($user){
?>
    <main class="edit-profile">
        <h1>Edit profile</h1>
        <form class="edit-profile-form" method="post" action="../actions/action_edit_profile.php">
            <input type="hidden" name="user" value="<?=$user['username']?>"></input>
            <label>name<br/>
                <input name="new_name" value="<?=$user['name']?>"></input> <br/><br/>
            </label>
            <label>username<br/>
                <input name="new_username" value="<?=$user['username']?>"></input> <br/><br/>
            </label>
            <label>email<br/>
                <input name="new_email" value="<?=$user['email']?>"></input> <br/><br/>
            </label> 
            <div class="cancel-done">
                <button type="button" onclick="window.location.href='profile.php'">Cancel</button>
                <button type="submit">Done</button>
            </div>
        </form>
    </main>
<?php
    }

    function outputChangePassword($user){
?>
        <main class="change-password">
            <h1>Change password</h1>
            <form class="change-password-form" method="post" action="../actions/action_change_password.php">
                <input type="hidden" name="user_email" value="<?=$user['email']?>"></input>
                <label>current password<br/>
                    <input name="current_password" type="password"></input> <br/><br/>
                </label>
                <label>new password<br/>
                    <input name="new_password" type="password"></input> <br/><br/>
                </label>
                <label>confirm new password<br/>
                    <input name="confirm_new_password" type="password"></input> <br/><br/>
                </label> 
                <div class="cancel-done">
                    <button type="button" onclick="window.location.href='profile.php'">Cancel</button>
                    <button type="submit">Done</button>
                </div>
            </form>
        </main>
<?php
    }
?>