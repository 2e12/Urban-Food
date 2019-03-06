<?php

namespace App\Controller;

use App\View\View;

class RegisterController
{
    public function index(): void
    {
        $view = new View('Register/index');
        $view->title = 'Register';
        $view->display();
    }
}