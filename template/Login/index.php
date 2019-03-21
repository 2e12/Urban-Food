<?php
echo
'<div class="content">
    <h1>Login</h1>
    <div class="formlayout">
         <div class="formblock">
            <form method="POST" action="Login/login" class="smallform">
                <input name="emailadress" placeholder="deine Email-Adresse" type="email">
                <input name="password" placeholder="dein Passwort" type="password">
                <div class="send"><input type="submit"></div>
            </form>
        </div>
        <div class="imageblock">
            <div class="images">
                <div class="TwoSpan"><img src="/img/upload/tiny_images/asia_tiny.jpg" alt="asia food"></div>
                <div class="OneSpan"><img src="/img/upload/tiny_images/burger_tiny.jpg" alt="burgers"></div>
                <div class="ThreeSpan"><img src="/img/upload/tiny_images/pizza_tiny.jpg" alt="pizzas"></div>
            </div>  
        </div>
    </div>
</div>';