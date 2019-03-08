<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\View\View;

class RegisterController
{
    public function index(): void
    {
        $view = new View('Register/index');
        $view->title = 'Register';
        $view->display();
    }

    public function register(): void
    {
        if (isset($_POST['emailadress']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['city']) && isset($_POST['postalcode']) && isset($_POST['street']) && isset($_POST['password']) && isset($_POST['repeatedpassword']))
        {
            if ($_POST['password'] == $_POST['repeatedpassword'])
            {
                Authentication::register( $_POST['city'], $_POST['postalcode'], $_POST['street'], $_POST['emailadress'], $_POST['firstname'], $_POST['lastname'], $_POST['password']);
            }
        }
        header('Location: /User/index');
    }
}