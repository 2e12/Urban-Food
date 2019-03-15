<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\UserRepository;
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

    public function grant(): void {
        $view = new View('User/grant');
        $view->title = 'Grant';
        $view->display();
    }

    public function create(): void {
        $view = new View('User/create');
        $view->title = 'Create';
        $view->display();
    }

    public function changePermissions(): void {
        if (isset($_POST['useremail']) && isset($_POST['newPerm']) && preg_match('([!#-\'*+/-9=?A-Z^-~-]+(\.[!#-\'*+/-9=?A-Z^-~-]+)*|"([]!#-[^-~ \t]|(\\[\t -~]))+")@([!#-\'*+/-9=?A-Z^-~-]+(\.[!#-\'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])', $_POST['emailadress'])) {
            $users = new UserRepository();
            $users->grantPerm(htmlspecialchars($_POST['useremail']), htmlspecialchars($_POST['newPerm']));
        }
        if (isset($_POST['useremail']) && isset($_POST['delUser']) && preg_match('([!#-\'*+/-9=?A-Z^-~-]+(\.[!#-\'*+/-9=?A-Z^-~-]+)*|"([]!#-[^-~ \t]|(\\[\t -~]))+")@([!#-\'*+/-9=?A-Z^-~-]+(\.[!#-\'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])', $_POST['emailadress'])) {
            $users = new UserRepository();
            $user = $users->readByEmail(htmlspecialchars($_POST['useremail']));
            if ($user != null) {
                $users->deleteById($user->id);
            }
        }
        header('Location: /User/grant');
    }

    public function logout(): void {
        Authentication::logout();
        $view = new View('User/logout');
        $view->title = 'User';
        $view->display();
    }

    public function wronginformations() {
        $view = new View('user/wronginformations');
        $view->title = 'Wrong Informations';
        $view->display();
    }

    public function forbidden(): void {
        $view = new View('/User/forbidden');
        $view->title = 'Forbidden!';
        $view->display();
    }
}