<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\View\View;

class LoginController
{
    public function index(): void
    {
        if (isset($_SESSION['user'])) {
            $view = new View('User/loggedin');
            $view->title = 'Already logged in';
            $view->display();
        }
        else {
            $view = new View('Login/index');
            $view->title = 'Login';
            $view->display();
        }
    }

    public function login(): void
    {
        if (isset($_POST['emailadress']) && isset($_POST['password']) && filter_var($_POST['emailadress'], FILTER_VALIDATE_EMAIL))
        {
            $loginstate = Authentication::login(htmlspecialchars($_POST['emailadress']), htmlspecialchars($_POST['password']));
            if ($loginstate == true) {
                header('Location: /User/index');
            } else {
                header('Location: /User/wronginformations');
            }
        }
    }
}