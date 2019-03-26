<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\View\View;

class IngredientController
{
    /**
     * Diese Funktion erstellt die View für das Erstellen einer neuen Zutat.
     */
    public function create(): void
    {
        $view = new View('Ingredient/create');
        $view->title = 'Create new ingredient';
        $view->display();
    }

    /**
     * Die Funktion erstellt die Zutat in der Datenbank
     */
    public function createIngredient(): void
    {
        if (isset($_POST["ingredientName"])) {
            $repo = new IngredientRepository();
            $repo->insert(htmlspecialchars($_POST['ingredientName']));
            header('Location: /Ingredient/create');
        }
    }

    /**
     * Diese Funktion erstellt die View für das Löschen einer Zutat.
     */
    public function delete(): void
    {
        $view = new View('Ingredient/delete');
        $view->title = 'Delete ingredient';
        $view->display();
    }

    /**
     * Die Funktion löscht die Zutat in der Datenbank
     */
    public function del(): void
    {
        if (isset($_GET['name'])) {
            $repo = new IngredientRepository();
            $repo->deleteByName(htmlspecialchars($_GET['name']));
            header('Location: /Ingredient/delete');
        }
    }
}
