<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\View\View;


class CategoryController
{
    public function index(): void
    {
        $repository = new CategoryRepository();
        $view = new View('Category/index');
        $view->categories = $repository->readAll();
        $view->display();
    }

    public function products(): void
    {
        $category_id = false;
        $valid = false;
        if (isset($_GET["category"])) {
            if (is_numeric($_GET["category"])) {
                $category_id = $_GET["category"];
                $valid = true;
            }
        }
        if (!$valid) {
            header("location: /category/");
            exit;
        }
        $productRepository = new ProductRepository();
        $categoryRepository = new categoryRepository();
        $category = $categoryRepository->readById($category_id);
        if ($category) {
            $view = new View('Category/product');
            $view->category = $category->name;
            $view->products = $productRepository->readByCategoryId($category_id);
            $view->display();
        }
        else {
            header("HTTP/1.0 404 Not Found");
            header("location: /category/");
            exit;
        }
    }

}