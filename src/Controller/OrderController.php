<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\Repository;
use App\Repository\UserRepository;
use App\View\View;

class OrderController
{
    /**
     * Gibt alle Bestellungen des aktuellen Users in ein bestimmtes Viewfile aus.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
    public function index(): void
    {
        if (isset($_SESSION["user"])) {
            $view = new View('Order/index');
            $view->title = 'Bestellungen';
            $repository = new OrderRepository();
            $view->orders = $repository->readByUserId($_SESSION["user"]);
            $view->display();
        }
    }

    /**
     * Sendet die Bestellung in die Datenbank und leert den Warenkorb.
     */
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

    /**
     * Überprüft ob der User eingeloogt ist, da dies erfoderlich ist um zu Bestellen.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
    public function checkout(): void
    {
        if (isset($_SESSION["order"])) {
            $view = new View('Order/checkout');
            $view->title = 'Checkout';
            $adress = null;
            $user = null;
            if (isset($_SESSION["user"])) {
                $repository = new UserRepository();
                $adress = $repository->readAdressByUserId($_SESSION["user"]);
                $user = $repository->readById($_SESSION["user"]);
            }
            $view->adress = $adress;
            $view->user = $user;
            $view->basket = $_SESSION["order"];
            $view->display();
        }
    }

    /**
     * Überprüft ob der User berechtigt ist, die Rechnung einzusehen und läst anschliessend die
     * passenden Rechnungen.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
    public function show(): void
    {
        $authenticated = false; //This Boolean indicates if an user can access an order.
        $order = null;
        $products = null;
        if (isset($_GET["id"]) and isset($_SESSION["user"])) {
            $repository = new OrderRepository();
            $order = $repository->readById($_GET["id"]);
            $products = $repository->readProductsByOrderId($_GET["id"]);
            if ($order !== null and $products !== null) {
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
        $repository = new UserRepository();
        $adress = $repository->readAdressByUserId($order->user_id);
        $user = $repository->readById($order->user_id);
        $view->adress = $adress;
        $view->user = $user;
        $view->title = 'Einkauf';
        $view->comment = $order->comment;
        $view->allergy = $order->allergy;
        $view->products = $products;
        $view->display();
    }

    /**
     * Validiert die Daten aus dem Warenkorb und leitet auf eine "Vielen Dank für den Einkauf"-Seite.
     * @throws \Exception Exception in der MySQLi-Verbindung
     */
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