<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\View\View;

class IngredientController
{
    public function create(): void {
        $view = new View('Ingredient/create');
        $view->title = 'Create new ingredient';
        $view->display();
    }

    public function createIngredient(): void {
      if (isset($_POST["ingredientName"])) {
          $repo = new IngredientRepository();
          $repo->insert(htmlspecialchars($_POST['ingredientName']));
          header('Location: /Ingredient/create');
      }
    }

    public function delete(): void {
        $view = new View('Ingredient/delete');
        $view->title = 'Delete ingredient';
        $view->display();
    }

    public function del(): void {
        if (isset($_GET['name'])) {
            $repo = new IngredientRepository();
            $repo->deleteByName(htmlspecialchars($_GET['name']));
            header('Location: /Ingredient/delete');
        }
    }
}
