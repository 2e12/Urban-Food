<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\View\View;

class OrderController
{
    public function index(): void
    {

    }

    public function buy(): void
    {
        if (isset($_SESSION["user"]) and isset($_SESSION["order"])) {
            //POST "Buy" is the submit button
            if (isset($_POST["buy"]) and isset($_POST["comment"]) and isset($_POST["allergy"])) {
                $comment = htmlspecialchars(substr($_POST["comment"], 0, 500));
                $allergy = htmlspecialchars(substr($_POST["allergy"], 0, 30));

                $repository = new OrderRepository();
                $id = $repository->insertOrder($_SESSION["user"], $comment, $allergy, $_SESSION["order"]);

                $view = new View('Order/buy');
                $view->title = 'Danke für Ihren Einkauf';
                $view->orderId = $id;
                $view->display();
                unset($_SESSION["order"]);
            }
            else {
                header("location: /");
                exit;
            }
        }
        else {
            header("location: /");
            exit;
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

    public function show(): void
    {
        $authenticated = false; //This Boolean indicates if an user can access an order.
        $order = null;
        $products = null;
        if (isset($_GET["id"]) and isset($_SESSION["user"])) {
            $repository = new OrderRepository();
            $order = $repository->readById($_GET["id"]);
            $products = $repository->readProductsByOrderId($_GET["id"]);
            if ($order and $products) {
                if ($order->user_id == $_SESSION["user"]) {
                    $authenticated = true;
                }
            }
        }
        if (!$authenticated) { //Go to start page in case user isn't allowed to see the order.
            header("location: /");
            exit;
        }
        $view = new View('Order/show');
        $view->title = 'Einkauf';
        $view->comment = $order->comment;
        $view->allergy = $order->allergy;
        $view->products = $products;
        $view->display();
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