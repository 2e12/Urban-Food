<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{
    /**
     * Überprüft ob der User eingeloggt ist und wenn ja, wird ein persönlicher Bereich geladen.
     */
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

    /**
     * Erstellt das Viewfile um den Usern Admin-Rechte zu gewähren.
     */
    public function grant(): void {
        $view = new View('User/grant');
        $view->title = 'Grant';
        $view->display();
    }

    /**
     * Erstellt das Viewfile um neue User zu erstellen.
     */
    public function create(): void {
        $view = new View('User/create');
        $view->title = 'Create';
        $view->display();
    }

    /**
     * Ändert die Berechtigung des Users in der Datenbank.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
    public function changePermissions(): void {
        if (isset($_POST['useremail']) && isset($_POST['newPerm']) && filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)) {
            $users = new UserRepository();
            $users->grantPerm(htmlspecialchars($_POST['useremail']), htmlspecialchars($_POST['newPerm']));
        }
        if (isset($_POST['useremail']) && isset($_POST['delUser']) && filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)) {
            $users = new UserRepository();
            $user = $users->readByEmail(htmlspecialchars($_POST['useremail']));
            if ($user != null) {
                $users->deleteById($user->id);
            }
        }
        header('Location: /User/grant');
    }

    /**
     * Erstellt das Viewfile um dem User mitzuteilen, dass er sich ausgeloggt hat.
     */
    public function logout(): void {
        Authentication::logout();
        $view = new View('User/logout');
        $view->title = 'User';
        $view->display();
    }

    /**
     * Erstellt das Viewfile um mitzuteilen, dass die Login-Informationen falsch sind.
     */
    public function wronginformations() {
        $view = new View('user/wronginformations');
        $view->title = 'Wrong Informations';
        $view->display();
    }

    /**
     * Erstellt das Viewfile um zu zeigen, dass der User kein Zugriff auf diesen Bereich hat.
     */
    public function forbidden(): void {
        $view = new View('/User/forbidden');
        $view->title = 'Forbidden!';
        $view->display();
    }
}