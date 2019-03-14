<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
if ($permission == true) {
    echo '<div class="content">
          <h1>Neuen Benutzer erfassen</h1>
          <div class="formblock">
            <form method="POST" action="/Register/create" class="smallform">
                <input name="emailadress" placeholder="deine Email-Adresse" type="email">
                <input name="firstname" placeholder="dein Vorname" >
                <input name="lastname" placeholder="dein Nachname">
                <input name="city" placeholder="Ort">
                <input name="postalcode" placeholder="Postleitzahl" type="number">
                <input name="street" placeholder="Strasse">
                <input name="password" placeholder="dein Passwort" type="password">
                <input name="repeatedpassword" placeholder="wiederhole dein Passwort" type="password">
                <div class="send"><input type="submit"></div>
            </form>    
        </div>
        </div>';
} else {
    header('Location: /User/forbidden');
}