<?php
echo
'<div class="content">
    <h1>Registrieren</h1>
    <form method="post" action="">
        <input name="emailadress" placeholder="deine Email-Adresse" type="email">
        <input name="firstname" placeholder="dein Vorname" >
        <input name="lastname" placeholder="dein Nachname">
        <input name="city" placeholder="Ort">
        <input name="postalcode" placeholder="Postleitzahl" type="number">
        <input name="street" placeholder="Strasse">
        <input name="password" placeholder="dein Passwort" type="password">
        <input name="repeatedpassword" placeholder="wiederhole dein Passwort" type="password">
        <button type="submit">einloggen</button>
    </form>    
</div>';