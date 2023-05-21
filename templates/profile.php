<?php
    function outputProfile($user, $visiting){
        $editProfile = "window.location.href='edit_profile.php'";
        $changePassword = "change_password.php";
        if ($visiting) {
            $editProfile = "window.location.href='edit_profile.php?username=".$user['username']."'";
            $changePassword = "change_password.php?username=".$user['username']."";
        }
?>
        <main class="profile-info">
            <div class="header-edit-profile">
                <h1>Profile</h1>
                <button onclick="<?=$editProfile?>">Edit profile</button>
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
<?php       
            if($user['role'] != 'client' && count($user['departments']) > 0){
?>
                <div>
                    <label>departments</label>
<?php
                foreach($user['departments'] as $department){
?>
                    <p><?=$department?></p>
<?php
                }
?>
                </div>
<?php
            }
?>
            <div class="change-pass-logout">
                <a href="<?=$changePassword?>">Change password</a>
<?php 
                if(!$visiting){ 
?>
                    <a href="../actions/action_logout.php">Logout</a>
<?php 
                } 
?>
            </div>
        </main>
<?php
    }

    function outputUserProfile($user){
?>
        <main class="profile-info">
            <div class="header-edit-profile">
                <h1>Profile</h1>
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
<?php       
            if($user['role'] != 'client' && count($user['departments']) > 0){
?>
                <div>
                    <label>departments</label>
<?php
                foreach($user['departments'] as $department){
?>
                    <p><?=$department?></p>
<?php
                }
?>
                </div>
<?php
            }
?>
        </main>
<?php
    }

    function outputEditProfile($user, $visiting){
        $profile = "window.location.href='profile.php'";
        if ($visiting) {
            $profile = "window.location.href='profile.php?username=".$user['username']."'";
        }
?>
    <main class="edit-profile">
        <h1>Edit profile</h1>
        <form id="edit-profile-form" class="edit-profile-form" method="post" action="../actions/action_edit_profile.php">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>"></input>
            <input type="hidden" name="visiting" value="<?=$visiting?>"></input>
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
<?php
            if($visiting) {
?>
                <label>role<br/>
                    <select name="new_role">
                        <option value="client" <?php if($user['role'] == 'client') echo 'selected';?>>client</option>
                        <option value="agent" <?php if($user['role'] == 'agent') echo 'selected';?>>agent</option>
                        <option value="admin" <?php if($user['role'] == 'admin') echo 'selected';?>>admin</option>
                    </select> <br/><br/>
                </label>
<?php
            }
            if(($user['role'] != 'client')){
?>
                <label id="departments-label">departments<br/>
                    <ul id="new_departments">
<?php
                    foreach($user['departments'] as $department){
?>
                        <li><p><?=$department?></p></li>
<?php
                    }
?>                      
                        <li><p id="add-remove-user-department">Add/Remove department</p></li>
                    </ul> <br/><br/>
                </label>
<?php           
            }
?>
            <div class="cancel-done">
                <button type="button" onclick="<?=$profile?>">Cancel</button>
                <button type="button" id="done-button-edit-profile">Done</button>
            </div>
        </form>
    </main>
<?php
    }

    function outputChangePassword($user, $visiting){
        $profile = "window.location.href='profile.php'";
        if ($visiting) {
            $profile = "window.location.href='profile.php?username=".$user['username']."'";
        }
?>
        <main class="change-password">
            <h1>Change password</h1>
            <form class="change-password-form" method="post" action="../actions/action_change_password.php">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>"></input>
                <input type="hidden" name="user" value="<?=$user['username']?>"></input>
                <input type="hidden" name="visiting" value="<?=$visiting?>"></input>
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
                    <button type="button" onclick="<?=$profile?>">Cancel</button>
                    <button type="submit">Done</button>
                </div>
            </form>
        </main>
<?php
    }
?>