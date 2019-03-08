<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\View\View;

class UserController
{
    public function index(): void {
        $view = new View('User/index');
        $view->title = 'User';
        $view->display();
    }

    public function logout(): void {
        Authentication::logout();
        $view = new View('User/logout');
        $view->title = 'User';
        $view->display();
    }

    public function wronginformations() {
        $view = new View('user/wronginformations');
        $view->titlw = 'Wring Informations';
        $view->display();
    }
}