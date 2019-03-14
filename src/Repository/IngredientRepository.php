<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class IngredientRepository extends Repository
{
    protected $tableName = 'ingredients';

    public function insert(string $textName): void {
        $insertQuery = "INSERT INTO {$this->tableName} (`name`) VALUES (?)";
        $insertStatement = ConnectionHandler::getConnection()->prepare($insertQuery);
        $insertStatement->bind_param('s', $textName);
        $insertStatement->execute();
        $insertStatement->close();
    }

    public function deleteByName(string $textName): void {
        $deleteQuery = "DELETE FROM {$this->tableName} WHERE `name`=?";
        $deleteStatement = ConnectionHandler::getConnection()->prepare($deleteQuery);
        $deleteStatement->bind_param('s', $textName);
        $deleteStatement->execute();
        $deleteStatement->close();
    }

    public function readByName(string $textName) {
        $selectQuery = "SELECT * FROM {$this->tableName} WHERE `name`=?";
        $selectStatement = ConnectionHandler::getConnection()->prepare($selectQuery);
        $selectStatement->bind_param('s', $textName);
        $selectStatement->execute();

        $result = $selectStatement->get_result();
        if (!$result) {
            throw new Exception($selectStatement->error);
        }

        $row = $result->fetch_object();
        return $row;
    }
}