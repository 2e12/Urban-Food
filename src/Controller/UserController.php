<?php

namespace App\Controller;

use App\View\View;

class UserController
{
    public function index(): void {
        $view = new View('User/index');
        $view->title = 'User';
        $view->display();
    }
}