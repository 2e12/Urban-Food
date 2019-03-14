<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\ProductRepository;
use App\View\View;

class OrderController
{
    public function index(): void
    {

    }

    public function buy(): void
    {
        if (isset($_POST["buy"]) and isset($_POST["comment"])) {
            $view = new View('Order/buy');
            $view->title = 'Danke für Ihren Einkauf';
            $view->display();
        }
    }

    public function checkout(): void
    {
        if (isset($_SESSION["order"])) {

            $view = new View('Order/checkout');
            $view->title = 'Checkout';
            $view->basket = $_SESSION["order"];
            $view->display();

        }
    }

    public function check(): void
    {
        $valid = false;
        $products = array();
        //JavaScript sends a Json with products form the shoppingcart
        if (isset($_POST["products"])) {
            $request_data = $_POST["products"];
            if (is_array($request_data)) {
                $valid = true;
                $repository = new ProductRepository();
                foreach ($request_data as $item) {
                    //Validating. Correct stuff will be filled in a new array.
                    if (isset($item["id"]) and isset($item["quantity"])) {
                        if (ctype_digit($item["id"]) and ctype_digit($item["quantity"])) {
                            $product = $repository->readById($item["id"]);
                            if ($product !== null) {
                                $product->quantity = $item["quantity"];
                                $products[] = array($product);
                            }
                        }
                        else {
                            $valid = false;
                        }
                    }
                    else {
                        $valid = false;
                    }
                }
            }
        }
        if (!$valid) {
            exit;
        }
        echo "ok"; //Necessary for client javascript redirection to order/checkout. Don't touch this!
        $_SESSION["order"] = $products;
    }
}