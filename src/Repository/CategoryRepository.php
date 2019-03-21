<?php

namespace App\Repository;

use App\Database\ConnectionHandler;

class CategoryRepository extends Repository
{
    protected $tableName = 'categories';

    /**
     * Baut Verbindung zur Datenbank auf und gibt Kategorien anhand der Id zurück.
     * @param $id Die Id zum Durchsuchen der Datenbank
     * @return array Die Ergebnisse
     */
    function readByCategoryId($id)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE id=?";

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
}