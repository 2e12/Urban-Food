<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\UserRepository;
use App\View\View;

class StaticController
{
    /**
     * Macht es möglich statische HTML-Files zu laden, in welchen kein PhP gebraucht wurde.
     */
    public function index(): void
    {
        $fragments = explode("/", $_SERVER['REQUEST_URI']);
        $page = $fragments[2];
        if (preg_match("/^[a-zA-Z0-9]+$/", $page)) {
            $pagePath = "../src/Static/" . $page . ".html";
            if (file_exists($pagePath)) {
                $view = new View("Static/index");
                $content = file_get_contents($pagePath);
                $view->content = $content;
                $view->display();
            }
        }
    }
}