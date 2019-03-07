<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class UserRepository extends Repository
{
    protected $tablename = 'user';

    public function readByEmail(string $email): object {
        $query = "SELECT * FROM {$this->tableName} WHERE email=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $email);

        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }
}