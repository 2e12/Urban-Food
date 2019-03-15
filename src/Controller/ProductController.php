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

    public function ingredients()
    {
        if (isset($_GET["id"])) {
            $view = new View('Product/ingredients');
            $ingredientRepository = new Product_IngredientRepository();
            $productRepository = new ProductRepository();
            $product = $productRepository->readById($_GET["id"]);
            $view->product = $product;
            $ingredients = $ingredientRepository->readByProductId($_GET["id"]);
            $view->ingredients = $ingredients;
            $view->title = "Zutaten";
            if ($product and $ingredients) {
                $view->display();
            }
            else {
                header("location: /");
            }
        }
    }

    public function del(): void {
        $repo = new ProductRepository();
        $repo->deleteById($_GET['id']);
        header('Location: /Product/delete');
        exit();
    }

    public function createProduct(): void {
        $repository = new ProductRepository();

        if (isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productDesc']) && isset($_POST['productCategory'])) {
            switch ($_POST['productCategory']) {
                case '0':
                    $catName = 'sandwich/';
                    break;
                case '1':
                    $catName = 'burger/';
                    break;
                case '2':
                    $catName = 'snack/';
                    break;
                case '3':
                    $catName = 'drink/';
                    break;
                case '4':
                    $catName = 'asia/';
                    break;
                case '5':
                    $catName = 'pizza/';
                    break;
                default:
                    $catName = null;
                    break;
            }
            move_uploaded_file($_FILES['productImage']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/img/upload/'.$catName.$_FILES['productImage']['name']);
            $repository->insert(htmlspecialchars($_POST['productName']), htmlspecialchars($_POST['productPrice']), htmlspecialchars($_POST['productPrice']), $_FILES['productImage'], htmlspecialchars($_POST['productCategory']));
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
        $p = $prodRepo->readByName(htmlspecialchars($_POST['product']));
        $i = $ingRepo->readByName(htmlspecialchars($_POST['ingredient']));
        echo $p->name.$i->name;
        $prodIngRepo = new Product_IngredientRepository();
        $prodIngRepo->insert($p->id, $i->id);
        header('Location: /Product/link');
    }
}
