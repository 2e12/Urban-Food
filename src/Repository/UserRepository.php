<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class UserRepository extends Repository
{
    protected $tablename = 'user';

    public function readByEmail(string $email)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE email=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }

    public function insert(string $city, string $postalcode, string $street, string $email, string $firstname, string $lastname, string $password)
    {
        $adressQuery = "INSERT INTO adress (city, postal_code, street) VALUES (?, ?, ?)";
        $adressSelectQuery = "SELECT id FROM adress WHERE city = ? AND postal_code = ? AND street = ?";

        $adressStatement = ConnectionHandler::getConnection()->prepare($adressQuery);
        $adressStatement->bind_param('sss', $city, $postalcode, $street);
        $adressStatement->execute();

        $adressSelectStatement = ConnectionHandler::getConnection()->prepare($adressSelectQuery);
        $adressSelectStatement->bind_param('sss', $city, $postalcode, $street);
        $adressSelectStatement->execute();
        $result = $adressSelectStatement->get_result();
        if (!$result) {
            throw new Exception($adressSelectStatement->error);
        }
        $row = $result->fetch_object();
        $result->close();

        $userQuery = "INSERT INTO {$this->tableName} (prename, lastname, password, email, adress_id, is_admin) VALUES (?, ?, ?, ?, ?, ?)";

        $userStatement = ConnectionHandler::getConnection()->prepare($userQuery);
        $userStatement->bind_param('ssssii', $firstname, $lastname, hash('sha256', $password), $email, $row->id, 0);
        $userStatement->execute();
    }
}