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

    /**
     * Baut Verbindung zur Datenbank auf und gibt produkte anhand der OrderId zurürck.
     * @param $id Die Id zum Durchsuchen der Datenbank
     * @return array Die Scuhergebnisse
     * @throws Exception Die Exception die bei der MySQLi-Verbindung entstehen kann
     */
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

    /**
     * Baut Verbindung zur Datenbank auf und gibt die Bestellung anhand der Id zurück.
     * @param int $userId Die Id zum Durchsuchen der Datenbank
     * @return array Die Suchergebnisse
     * @throws Exception Die Esception die bei der MySQLi-Verbindung entstehen kann
     */
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

    /**
     * Baut Verbindung zur Datenbank auf und fügt eine Bestellung ein.
     * @param int $userId Die Id zum Durchsuchen der Datenbank
     * @param string $comment Der Kommentar des Users
     * @param string $allergy Allfällige Allergien des Users
     * @param array $products Die Produkte im Warenkorb
     * @return int Die Id der neuen Order
     */
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