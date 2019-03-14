<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;

if ($permission == true) {
    echo '
<div class="content">
    <h1>Neue Zutat erfassen</h1>
    <form method="POST" action="/Ingredient/createIngredient" class="smallform">
        <input name="ingredientName" type="text" placeholder="Name der Zuatat" required>
        <div class="send"><input type="submit"></div>
    </form>
</div>
';
} else {
    header('Location: /User/forbidden');
}
