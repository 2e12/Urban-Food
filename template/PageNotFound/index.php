<?php
    header("HTTP/1.0 404 Not Found");
    echo '<div class="content"><h1>Error 404</h1><br><h2>Page not found</h2><br><img src="http://' . $_SERVER["SERVER_NAME"] . '/img/PageNotFoundSmiley.png" alt="error404"></div>';
?>