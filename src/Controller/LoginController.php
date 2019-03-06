<?php

namespace App\Controller;

use App\View\View;

class LoginController
{
    public function index(): void
    {
        $view = new View('Login/index');
        $view->title = 'Login';
        $view->display();
    }
}