<?php
namespace App\Controller;
use App\View\View;

class PageNotFoundController {
        public function index() : void {
        header('Location: PageNotFound');
        $view = new View('PageNotFound/index');
        $view->title = 'Seite nicht gefunden';
        $view->display();
    }
}
