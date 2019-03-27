<?php

namespace App\Authentication;

use App\Repository\UserRepository;
use RuntimeException;

class Authentication
{
    /**
     * Diese Funktion überprüft ob die vom User eingegebenen Daten auch in der Datenbank
     * vorhanden sind. Falls ja, schreibt sie auch die UserId in den SESSION-Array.
     * @param $email Die vom User eingegebene Email-Adresse
     * @param $password Das vom User mitgegebene Passwort
     * @return bool Der Wert der aussagt, ob das Login erfolgreich war
     */
    public static function login($email, $password): bool
    {
        // Den Benutzer anhand der E-Mail oder des Benutzernamen auslesen
        $users = new UserRepository();
        $user = $users->readByEmail($email);

        if ($user != null) {
            // TODO: Mitgegebenes Passwort hashen
            $password_hash = hash('sha256', $password);

            // Prüfen ob der Password-Hash dem aus der Datenbank entspricht
            if ($password_hash == $user->password) {
                // Login successful
                // TODO: User-ID in die Session schreiben
                $_SESSION['user'] = $user->id;
                return true;
            }
        }
        return false;
    }

    /**
     * Diese Funktion legt anhand der Daten des Users einen neuen Benutzer in der Datenbank an.
     * @param string $textCity Die Stadt in der der User wohnt
     * @param string $textPostalcode Die Postleitzahl der eben erwähnten Stadt
     * @param string $textStreet Die Strasse in der der User lebt
     * @param string $textEmail Die Email-Adresse des Users
     * @param string $textFirstname Vorname des Users
     * @param string $textLastname Nachname des Users
     * @param string $textPassword Das vom User gewählte Passwort
     * @param bool $textFast Ein Wert der aussagt, ob ein normaler User den Account anlegt, oder ein Admin viele Accounts anlegen will
     */
    public static function register(string $textCity, string $textPostalcode, string $textStreet, string $textEmail, string $textFirstname, string $textLastname, string $textPassword, bool $textFast)
    {
        $users = new UserRepository();
        $users->insert($textCity, $textPostalcode, $textStreet, $textEmail, $textFirstname, $textLastname, $textPassword, $textFast);
    }

    /**
     * Mit dieser Funktion kann ein User sich ausloggen und damit die Session
     * zurücksetzen und anschliessend löschen.
     */
    public static function logout(): void
    {
        // TODO: Mit unset die Session-Werte löschen
        unset($_SESSION);

        // TODO: Session zerstören
        session_destroy();
    }

    /**
     * Diese Funktion prüft ob der aktive User in der Datenbank als Administrator erfasst ist.
     * @param $textEmail Die Email-Adresse des aktiven Users
     * @return bool Der Wert sagt aus, ob der User nun ein Admin ist oder nicht
     */
    public static function isAdmin($textEmail): bool
    {
        $users = new UserRepository();
        $user = $users->readByEmail($textEmail);

        if ($user != null) {
            if ($user->is_admin == 0) {
                return false;
            }
            elseif ($user->is_admin == 1) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    /**
     * Überprüft, ob in Session momentan eine UserId gespeichert ist.
     * @return bool Sagt aus ob nun eine UserId gesetzt ist oder nicht
     */
    public static function isAuthenticated(): bool
    {
        // TODO: Zurückgeben ob eine ID in der Session gespeichert wurde (true/false)
        if ($_SESSION['user'] == null) {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Gibt dem eingeloggten User aus der Datenbank zurück.
     * @return \App\Repository\Der Das User-Objekt aus der Datenbank
     * @throws \Exception Eine mögliche Exception von der Datenbank-Verbindung
     */
    public static function getAuthenticatedUser()
    {
        // TODO: User anhand der ID aus der Session auslesen
        $users = new UserRepository();
        $user = $users->readById($_SESSION['user']);

        // TODO: User zurückgeben
        return $user;
    }
}