<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\View\View;

class UserController
{
    public function index(): void {

        if (isset($_SESSION['user'])) {
            $view = new View('User/index');
            $view->title = 'User';
            $view->display();
        }
        else {
            $view = new View('User/loggedout');
            $view->title = 'Login';
            $view->display();
        }
    }

    public function logout(): void {
        Authentication::logout();
        $view = new View('User/logout');
        $view->title = 'User';
        $view->display();
    }

    public function wronginformations() {
        $view = new View('user/wronginformations');
        $view->title = 'Wring Informations';
        $view->display();
    }
}