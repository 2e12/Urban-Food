<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
if ($permission == true) {
    echo '<div class="content">
        <h1>Rechte vergeben</h1>
        <form method="POST" action="/User/changePermissions">
            <input name="useremail" type="email" placeholder="Email des Users" required>
            <input name="newPerm" type="text" placeholder="Freigabe [true/false]">
            <label><input name="delUser" type="checkbox">User löschen (Freigabe leerlassen)</label>
            <div class="send"><input type="submit"></div>
        </form>
        </div>';
}