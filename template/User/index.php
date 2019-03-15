<?php
$firstname = \App\Authentication\Authentication::getAuthenticatedUser()->prename;
$permissions = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;

echo  '<div class="content">
      <h1>Hallo '. $firstname .'</h1><br>
      <p>Was möchtest du tun?</p><br>
      <a class="linkbutton" href="/User/logout">abmelden</a><br>';

if ($permissions == true) {
    echo '<a class="linkbutton" href="/User/create">neue User erfassen</a><br>
          <a class="linkbutton" href="/User/grant">Berechtigungen bearbeiten</a><br>
          <a class="linkbutton" href="/Ingredient/create">neue Zutat erfassen</a><br>
          <a class="linkbutton" href="/Ingredient/delete">Zutat löschen</a><br>
          <a class="linkbutton" href="/Product/link">Zutat zu Produkt hinzufügen</a><br>
          <a class="linkbutton" href="/Product/create">neues Produkt erfassen</a><br>
          <a class="linkbutton" href="/Product/delete">Produkt aus Sortiment löschen</a><br>
          <a class="linkbutton" href="/order">Bestellungen</a><br>';
}
else {
    echo '<a class="linkbutton" href="/category">weiter zum Shop</a><br>';
    echo '<a class="linkbutton" href="/order">Bestellungen</a><br>';
}

echo '</div>';