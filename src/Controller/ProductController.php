<?php

namespace App\Controller;

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
}
