<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\Product_IngredientRepository;
use App\Repository\ProductRepository;
use App\View\View;


class ProductController
{
    /**
     * Erstellt das Viewfile für den index.
     */
    public function index(): void
    {
        $view = new View('Product/index');
        $view->title = 'Products';
        $view->display();
    }

    /**
     * Erstellt das Viewfile für das Erstellen eines neuen Produkts.
     */
    public function create(): void {
        $view = new View('Product/create');
        $view->title = 'Create new product';
        $view->display();
    }

    /**
     * Erstellt das Viewfile für das Löschen eines Produkts.
     */
    public function delete(): void {
        $view = new View('Product/delete');
        $view->title = 'Delete';
        $view->display();
    }

    /**
     * Läst die Zutaten aus einer Zwischentabelle anhand der Id des Produkts.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
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

    /**
     * Löscht Produkt aus der Datenbank.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
    public function del(): void {
        $repo = new ProductRepository();
        $repo->deleteById($_GET['id']);
        header('Location: /Product/delete');
        exit();
    }

    /**
     * Gibt das neue Produkt an das Repo weiter, weist die richtige Kategorie zu
     * und speichert das im Formular hochgeladene File auf dem Server.
     */
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

    /**
     * Gibt das Produkt anhand der Produkt Id aus.
     */
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

    /**
     * Erstellt das Viewfile für das Verbinden von Produkten und Zuateten.
     */
    public function link(): void {
        $view = new View('Product/link');
        $view->title = 'Link';
        $view->display();
    }

    /**
     * Erstellt die neue Verbindung zwischen Produkt und Zutat in der Datenbank.
     */
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
