<?php

namespace App\Controller;

use App\View\View;

class PageNotFoundController
{
    public function index(): void
    {
        header("HTTP/1.0 404 Not Found");
        $view = new View('PageNotFound/index');
        $view->title = 'Seite nicht gefunden';
        $view->display();
    }
}
