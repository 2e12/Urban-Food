<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
if ($permission == true) {
    echo '<div class="content">
          
          </div>';
}