<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
$users = new \App\Repository\UserRepository();
$arrUsers = $users->readAll();
if ($permission == true) {
    echo '<div class="content">
        <div class="grant">
        <h1>Rechte vergeben</h1>
        <form method="POST" action="/User/changePermissions">
            <input name="useremail" type="email" placeholder="Email des Users" required>
            <input name="newPerm" type="text" placeholder="Freigabe [true/false]">
            <label><input name="delUser" type="checkbox">User löschen (Freigabe leerlassen)</label>
            <div class="send"><input type="submit"></div>
        </form>
        </div>
        <div class="users">
            <table>
                <tr>
                    <td>E-Mail</td>
                    <td>Vorname</td>
                    <td>Nachname</td>
                    <td>Adminberechtigungen</td>
                </tr>
                ';
                foreach ($arrUsers as $user) {
                    echo '<tr>
                            <td>'.$user->email.'</td>
                            <td>'.$user->prename.'</td>
                            <td>'.$user->lastname.'</td>
                            <td>'.$user->is_admin.'</td>
                          </tr>';
                }
                echo '
            </table>
        </div>
        </div>';
}