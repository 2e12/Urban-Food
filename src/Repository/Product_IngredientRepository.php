<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class Product_IngredientRepository extends Repository
{
    protected $tableName = 'product_ingredient';

    public function readByProductId(int $productId): array
    {
        $query = "SELECT * FROM {$this->tableName} JOIN ingredient ON ingredient_id = ingredient.id WHERE product_id = ? LIMIT 0, 100";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param("i", $productId);
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

    public function insert(int $prodId, int $ingId): void {
        $insertQuery = "INSERT INTO {$this->tableName} (product_id,ingredient_id) VALUES (?,?)";
        $insertStatement = ConnectionHandler::getConnection()->prepare($insertQuery);
        $insertStatement->bind_param('ii', $prodId, $ingId);
        $insertStatement->execute();
        $insertStatement->close();
    }
}