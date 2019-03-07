<?php

namespace App\Authentication;

use App\Repository\UserRepository;
use RuntimeException;

class Authentication
{
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

    public static function logout(): void
    {
        // TODO: Mit unset die Session-Werte löschen
        unset($_SESSION);

        // TODO: Session zerstören
        session_destroy();
    }

    public static function isAuthenticated(): bool
    {
        // TODO: Zurückgeben ob eine ID in der Session gespeichert wurde (true/false)
        if ($_SESSION['user'] == null)
        {
            return false;
        } else {
            return true;
        }
    }

    public static function getAuthenticatedUser(): string
    {
        // TODO: User anhand der ID aus der Session auslesen
        $users = new UserRepository();
        $user = $users->readById($_SESSION['user']);

        // TODO: User zurückgeben
        return $user->email;
    }

    public static function restrictAuthenticated(): void
    {
        if (!self::isAuthenticated()) {
            throw new RuntimeException("Sie haben keine Berechtigung diese Seite anzuzeigen.");
            // TODO: Loggen! Unbefungte Zugriffsversuche sollten geloggt werden
            exit();
        }
    }
}