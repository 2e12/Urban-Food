<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class IngredientRepository extends Repository
{
    protected $tableName = 'ingredient';

    /**
     * Baut Verbindung zur Datenbank auf und fügt eine neue Zutat ein.
     * @param string $textName Der Name der Zutat
     */
    public function insert(string $textName)
    {
        $insertQuery = "INSERT INTO {$this->tableName} (`name`) VALUES (?)";
        $insertStatement = ConnectionHandler::getConnection()->prepare($insertQuery);
        $insertStatement->bind_param('s', $textName);
        $insertStatement->execute();
        $insertStatement->close();
    }

    /**
     * Baut Verbindung zur Datenbank auf und löscht eine Zutat anhand des Namens.
     * @param string $textName Der Name der Zutat
     */
    public function deleteByName(string $textName)
    {
        $deleteQuery = "DELETE FROM {$this->tableName} WHERE `name`=?";
        $deleteStatement = ConnectionHandler::getConnection()->prepare($deleteQuery);
        $deleteStatement->bind_param('s', $textName);
        $deleteStatement->execute();
        $deleteStatement->close();
    }

    /**
     * Baut Verbindung zur Datenbank auf und gibt eine Zutat mit bestimmten Namen zurück.
     * @param string $textName Der Name der Zutat
     * @return mixed Die gefundenen Entitäten
     */
    public function readByName(string $textName)
    {
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