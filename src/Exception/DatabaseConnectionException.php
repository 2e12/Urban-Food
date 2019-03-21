<?php

namespace App\Exception;

use Exception;

class DatabaseConnectionException extends Exception
{
    /**
     * DatabaseConnectionException constructor.
     * @param $errors Änfällige Errors die angezeigt werden sollen.
     */
    public function __construct($errors)
    {
        $message = 'Verbindungsfehler zur Datenbank';
        $code = 0;
        $previous = null;

        parent::__construct($message, $code, $previous);
    }
}
