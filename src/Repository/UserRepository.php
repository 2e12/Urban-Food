<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class UserRepository extends Repository
{
    protected $tableName = 'users';

    public function readByEmail(string $textEmail)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE email = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $textEmail);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            return null;
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }

    public function insert(string $city, string $postalcode, string $street, string $email, string $firstname, string $lastname, string $password)
    {
        $adressQuery = "INSERT INTO adress (city, postal_code, street) VALUES (?, ?, ?)";
        $adressSelectQuery = "SELECT * FROM adress WHERE city = ? AND postal_code = ? AND street = ?";

        $adressStatement = ConnectionHandler::getConnection()->prepare($adressQuery);
        $adressStatement->bind_param('sss', $city, $postalcode, $street);
        $adressStatement->execute();
        $adressStatement->close();

        $adressSelectStatement = ConnectionHandler::getConnection()->prepare($adressSelectQuery);
        $adressSelectStatement->bind_param('sss', $city, $postalcode, $street);
        $adressSelectStatement->execute();
        $result = $adressSelectStatement->get_result();
        if (!$result) {
            throw new Exception($adressSelectStatement->error);
        }
        $row = $result->fetch_object();
        $result->close();

        $userQuery = "INSERT INTO users (prename, lastname, password, email, adress_id, is_admin) VALUES (?, ?, ?, ?, ?, false)";

        $userStatement = ConnectionHandler::getConnection()->prepare($userQuery);
        $passwordhash = hash('sha256', $password);
        $userStatement->bind_param('ssssi', $firstname, $lastname, $passwordhash, $email, $row->id);
        $userStatement->execute();
        $userStatement->close();

        $_SESSION['user'] = ConnectionHandler::getConnection()->insert_id;
    }
}