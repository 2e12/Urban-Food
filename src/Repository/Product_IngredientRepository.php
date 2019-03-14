<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class Product_IngredientRepository extends Repository
{
    protected $tableName = 'product_ingredient';

    public function insert(int $prodId, int $ingId): void {
        $insertQuery = "INSERT INTO {$this->tableName} (product_id,ingredient_id) VALUES (?,?)";
        $insertStatement = ConnectionHandler::getConnection()->prepare($insertQuery);
        $insertStatement->bind_param('ii', $prodId, $ingId);
        $insertStatement->execute();
        $insertStatement->close();
    }
}