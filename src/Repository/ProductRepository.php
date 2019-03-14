<?php

namespace App\Repository;


use App\Database\ConnectionHandler;

class ProductRepository extends Repository
{
    protected $tableName = 'product';

    function readByCategoryId($id)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE category_id=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        $result->close();
        return $rows;

        // Datenbankressourcen wieder freigeben
    }

    function insert(string $textName, $textPrice, string $textDesc, array $arrImage, string $textCatId): void {
        $insertQuery = "INSERT INTO {$this->tableName} (`name`,price,description,image_path,category_id) VALUES (?,?,?,?,?)";
        $insertStatement = ConnectionHandler::getConnection()->prepare($insertQuery);
        $price = doubleval($textPrice);
        switch ($textCatId) {
            case '0':
                $catName = 'sandwich/';
                break;
            case '1':
                $catName = 'burger/';
                break;
            case '2':
                $catName = 'snack/';
                break;
            case '3':
                $catName = 'drink/';
                break;
            case '4':
                $catName = 'asia/';
                break;
            case '5':
                $catName = 'pizza/';
                break;
            default:
                $catName = null;
                break;
        }
        $cId = intval($textCatId);
        $dbPrefix = '/img/upload/'.$catName;
        $path = $dbPrefix.$arrImage['name'];
        $insertStatement->bind_param('sdssi', $textName, $price, $textDesc, $path, $cId);
        $insertStatement->execute();
        $insertStatement->close();
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