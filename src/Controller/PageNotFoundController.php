<?php
namespace App\Controller;


class PageNotFoundController
{
    public function index() {
        $view = new View('pagenotfound/index');
        $view->content = "<h1>Error 404</h1><br><h2>Page not found</h2><br><img src='../../public/img/PageNotFoundSmiley.JPG' alt='error404'>";
        $view->display();
    }
}