<?php
/**
 * Created by PhpStorm.
 * User: bbeutg
 * Date: 13.03.2019
 * Time: 15:26
 */

namespace App\Repository;


use App\Database\ConnectionHandler;

class OrderRepository extends Repository
{
    protected $tableName = 'ordering';

    function insertOrder(int $userId, string $comment, string $allergy, array $products): int
    {
        $db = ConnectionHandler::getConnection();
        $query = "INSERT INTO `ordering`(`user_id`,  `comment`, `allergy`) VALUES (?,?,?)";
        $statment = $db->prepare($query);

        $statment->bind_param('iss', $userId, $comment, $allergy);
        $statment->execute();

        $orderId = $db->insert_id;

        $query = "INSERT INTO `ordering_product`(`ordering_id`, `product_id`) VALUES (?,?)";
        $statment = $db->prepare($query);
        foreach ($products as $product) {
            $statment->bind_param('ii', $orderId, $product[0]->id);
            $statment->execute();
        }

        return $orderId;
    }
}