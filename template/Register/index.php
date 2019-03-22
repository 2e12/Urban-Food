<?php
echo
'<div class="content">
    <h1>Registrieren</h1>
    <div class="formlayout">
        <div class="formblock">
            <form method="POST" action="Register/register" class="smallform">
                <input name="emailadress" placeholder="deine Email-Adresse" type="email"  required>
                <input name="firstname" placeholder="dein Vorname"  required>
                <input name="lastname" placeholder="dein Nachname"  required>
                <input name="city" placeholder="Ort" required>
                <input name="postalcode" placeholder="Postleitzahl" type="text" pattern="^\\d{4}$" required> <!-- RegEx pattern not supported for numbers -->
                <input name="street" placeholder="Strasse" required>
                <input name="password" placeholder="dein Passwort" type="password" required>
                <input name="repeatedpassword" placeholder="wiederhole dein Passwort" type="password" required>
                <div class="send"><input type="submit"></div>
            </form>    
        </div>
        <div class="imageblock">
            <div class="images">
                <div class="ThreeSpan"><img src="/img/upload/asia/asia.jpg" alt="asia food"></div>
                <div class="TwoSpan"><img src="/img/upload/snack/snacks.jpg" alt="pizzas"></div>
            </div>
        </div>
    </div>
</div>';