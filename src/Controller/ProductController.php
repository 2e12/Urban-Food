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

    //public function category() : void{
    //
    //}

    public function get(): void
    {
        header('Content-Type: application/json');
        $repository = new ProductRepository();
        if (isset($_GET["id"])) {
            echo json_encode($repository->readById($_GET["id"]));
        }
        else {
            echo json_encode($repository->readAll());
        }
    }
}
