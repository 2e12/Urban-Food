<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\Product_IngredientRepository;
use App\Repository\ProductRepository;
use App\View\View;


class ProductController
{
    public function index(): void
    {
        $view = new View('Product/index');
        $view->title = 'Products';
        $view->display();
    }

    public function create(): void {
        $view = new View('Product/create');
        $view->title = 'Create new product';
        $view->display();
    }

    public function delete(): void {
        $view = new View('Product/delete');
        $view->title = 'Delete';
        $view->display();
    }

    public function del(): void {
        $repo = new ProductRepository();
        $repo->deleteById($_GET['id']);
        header('Location: /Product/delete');
        exit();
    }

    public function createProduct(): void {
        $repository = new ProductRepository();
        if (isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productDesc']) && isset($_POST['productPath']) && isset($_POST['productCategory'])) {
            $repository->insert($_POST['productName'], $_POST['productPrice'], $_POST['productDesc'], $_POST['productPath'], $_POST['productCategory'],);
        }
        header('Location: /Product/create');
    }

    public function get(): void
    {
        header('Content-Type: application/json');
        $repository = new ProductRepository();
        if (isset($_GET["id"])) {
            try {
                echo json_encode($repository->readById($_GET["id"]));
            } catch (\Exception $e) {
                echo "null";
            }
        }
        else {
            try {
                echo json_encode($repository->readAll());
            } catch (\Exception $e) {
                echo "null";
            }
        }
    }

    public function link(): void {
        $view = new View('Product/link');
        $view->title = 'Link';
        $view->display();
    }

    public function linkProdWIng(): void {
        $prodRepo = new ProductRepository();
        $ingRepo = new IngredientRepository();
        echo $_POST['product'].$_POST['ingredient'];
        $p = $prodRepo->readByName($_POST['product']);
        $i = $ingRepo->readByName($_POST['ingredient']);
        echo $p->name.$i->name;
        $prodIngRepo = new Product_IngredientRepository();
        $prodIngRepo->insert($p->id, $i->id);
        header('Location: /Product/link');
    }
}
