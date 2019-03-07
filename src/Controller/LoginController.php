<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\View\View;

class LoginController
{
    public function index(): void
    {
        $view = new View('Login/index');
        $view->title = 'Login';
        $view->display();
    }

    public function login(): void
    {
        if (isset($_POST['emailadress']) && isset($_POST['password']))
        {
            Authentication::login($_POST['emailadress'], $_POST['password']);
        }
    }
}