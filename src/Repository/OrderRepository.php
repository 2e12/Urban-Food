<?php
/**
 * Created by PhpStorm.
 * User: bbeutg
 * Date: 13.03.2019
 * Time: 15:26
 */

namespace App\Repository;


use App\Database\ConnectionHandler;
use Exception;

class OrderRepository extends Repository
{
    protected $tableName = 'ordering';

    function readProductsByOrderId($id)
    {
        $db = ConnectionHandler::getConnection();

        $query = "SELECT product.id, product.name, product.price, ordering_product.quantity  FROM `ordering_product` JOIN product ON ordering_product.product_id = product.id WHERE `ordering_id` = ?";
        $statement = $db->prepare($query);

        $statement->bind_param('i', $id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function readByUserId(int $userId): array
    {
        $query = "SELECT * FROM ordering WHERE user_id = ? LIMIT 0, 100";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

    function insertOrder(int $userId, string $comment, string $allergy, array $products): int
    {
        $db = ConnectionHandler::getConnection();
        $query = "INSERT INTO `ordering`(`user_id`,  `comment`, `allergy`) VALUES (?,?,?)";
        $statement = $db->prepare($query);

        $statement->bind_param('iss', $userId, $comment, $allergy);
        $statement->execute();

        $orderId = $db->insert_id;

        $query = "INSERT INTO `ordering_product`(`ordering_id`, `product_id`, `quantity`) VALUES (?,?,?)";
        $statement = $db->prepare($query);
        foreach ($products as $product) {
            $statement->bind_param('iii', $orderId, $product[0]->id, $product[0]->quantity);
            $statement->execute();
        }

        return $orderId;
    }
}