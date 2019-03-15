<?php
echo
'<div class="content">
    <h1>Registrieren</h1>
    <div class="formlayout">
        <div class="formblock">
            <form method="POST" action="Register/register" class="smallform">
                <input name="emailadress" placeholder="deine Email-Adresse" type="email">
                <input name="firstname" placeholder="dein Vorname" >
                <input name="lastname" placeholder="dein Nachname">
                <input name="city" placeholder="Ort">
                <input name="postalcode" placeholder="Postleitzahl" type="number" pattern="^\\d{4}$">
                <input name="street" placeholder="Strasse">
                <input name="password" placeholder="dein Passwort" type="password">
                <input name="repeatedpassword" placeholder="wiederhole dein Passwort" type="password">
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