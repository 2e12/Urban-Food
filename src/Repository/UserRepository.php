<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use App\View\View;

class UserRepository extends Repository
{
    protected $tableName = 'users';

    /**
     * Baut Verbindung zur Datenbank auf und gibt einen User anhand seiner Id zurück.
     * @param $userId Die Id des Users
     * @return |null Die Suchergebnisse
     */
    public function readAdressByUserId($userId)
    {
        $db = ConnectionHandler::getConnection();
        $query = "SELECT adress.id, adress.city, adress.postal_code, adress.street FROM `users` JOIN `adress` ON users.adress_id = adress.id WHERE users.id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            return null;
        }

        $row = $result->fetch_object();

        $result->close();

        return $row;
    }

    /**
     * Baut Verbindung zur Datenbank auf und gibt einen User anhand seiner Email-Adresse zurück.
     * @param string $textEmail Die Email-Adresse des Users
     * @return |null Die Suchergebnisse
     */
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

    /**
     * Baut Verbindung zur Datenbank auf und fügt einen neuen User ein.
     * @param string $city Die Stadt in der der User lebt
     * @param string $postalcode Die Postleitzahl des Users
     * @param string $street Die Strasse in der der User wohnt
     * @param string $email Die Email-Adresse des Users
     * @param string $firstname Der Vorname des Users
     * @param string $lastname Der Nachname des Users
     * @param string $password Das vom User gewählte Passwort
     * @param bool $fast Gibt an ob die Aktion vom Admin oder vom normalen User gemacht wurde
     */
    public function insert(string $city, string $postalcode, string $street, string $email, string $firstname, string $lastname, string $password, bool $fast)
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

        if ($fast == false) {
            $_SESSION['user'] = ConnectionHandler::getConnection()->insert_id;
        }
    }

    /**
     * Baut Verbindung zur Datenbank auf und ändert den Administratorenstatus einer Person
     * @param string $userEmail Die Email-Adresse des betroffenen Users
     * @param string $perm Die neue Freigabe
     */
    public function grantPerm(string $userEmail, string $perm): void {
        $user = $this->readByEmail($userEmail);
        if ($user != null) {
            if ($perm == 'true') {
                $newPerm = 1;
            } else {
                $newPerm = 0;
            }
            $grantQuery = "UPDATE users SET is_admin = ? WHERE id = ?";
            $grantStatement = ConnectionHandler::getConnection()->prepare($grantQuery);
            $grantStatement->bind_param('ii', $newPerm, $user->id);
            $grantStatement->execute();
            $grantStatement->close();
        }
    }
}