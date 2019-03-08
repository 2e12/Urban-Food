<?php
$firstname = \App\Authentication\Authentication::getAuthenticatedUser()->prename;
echo  '<h1>Hallo '. $firstname .'</h1><br>
      <p>Was möchtest du tun?</p><br>
      <a href="/User/logout">abmelden</a><br>
      <div class="adminarea"><button>hallowelt</button></div>';