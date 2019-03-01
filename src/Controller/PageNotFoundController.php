<?php
namespace App\Controller;


class PageNotFoundController
{
    public function index() {
        echo "<h1>Error 404</h1><br><h2>Page not found</h2><br><img src='../../public/img/PageNotFoundSmiley.JPG'>";
    }
}