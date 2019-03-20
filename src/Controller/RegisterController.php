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
            if ($_POST['password'] == $_POST['repeatedpassword'] && filter_var($_POST['emailadress'], FILTER_VALIDATE_EMAIL) && preg_match("/^[1-9]\d{3}$/", $_POST['postalcode']))
            {
                Authentication::register(htmlspecialchars($_POST['city']), htmlspecialchars($_POST['postalcode']), htmlspecialchars($_POST['street']), htmlspecialchars($_POST['emailadress']), htmlspecialchars($_POST['firstname']), htmlspecialchars($_POST['lastname']), htmlspecialchars($_POST['password']), false);
                Authentication::login(htmlspecialchars($_POST['emailadress']), htmlspecialchars($_POST['password']));
                header('Location: /User/index');
            }
        }
    }

    public function create() {
        if (isset($_POST['emailadress']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['city']) && isset($_POST['postalcode']) && isset($_POST['street']) && isset($_POST['password']) && isset($_POST['repeatedpassword']))
        {
            if ($_POST['password'] == $_POST['repeatedpassword'] && filter_var($_POST['emailadress'], FILTER_VALIDATE_EMAIL) && preg_match('/^[1-9]\d{3}$/', $_POST['postalcode']))
            {
                Authentication::register(htmlspecialchars($_POST['city']), htmlspecialchars($_POST['postalcode']), htmlspecialchars($_POST['street']), htmlspecialchars($_POST['emailadress']), htmlspecialchars($_POST['firstname']), htmlspecialchars($_POST['lastname']), htmlspecialchars($_POST['password']), true);
                header('Location: /User/create');
            }
        }
    }
}