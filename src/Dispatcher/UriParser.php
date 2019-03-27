<?php

namespace App\Dispatcher;

class UriParser
{
    /**
     * Diese Methode wertet die Request URI aus und gibt den Controllername zurück.
     */
    public static function getControllerName(): string
    {
        $uriFragments = self::getUriFragments();
        // TODO: Methode um den "Controller"-Teil der URI zurückzugeben
        // http://my-project.local/default/index    ->      "Default"
        // http://my-project.local/user/create      ->      "User"
        // http://my-project.local                  ->      "Default"

        if (isset($uriFragments[0]) && class_exists('App\\Controller\\' . ucfirst($uriFragments[0]) . 'Controller')) {
            return ucfirst($uriFragments[0]);
        }
        elseif (empty($uriFragments[0])) {
            return 'Default';
        }
        else {
            return 'PageNotFound';
        }
    }

    /**
     * Diese Methode wertet die Request URI aus und gibt den Actionname (Action = Methode im Controller) zurück.
     */
    public static function getMethodName(): string
    {
        $uriFragments = self::getUriFragments();
        // TODO: Methode um den "Action"-Teil der URI zurückzugeben
        // http://my-project.local/default/index    ->      "index"
        // http://my-project.local/user/create      ->      "create"
        // http://my-project.local                  ->      "index"

        if (!empty($uriFragments[1])) {
            if (method_exists('App\\Controller\\' . ucfirst($uriFragments[0]) . 'Controller', $uriFragments[1])) {
                return $uriFragments[1];
            }
            else {
                return 'index';
            }
        }
        else {
            return 'index';
        }
    }

    /**Gibt den Namen des Controllers und der Methode zurück.
     * @return array Controllername und Funktionname
     */
    private static function getUriFragments(): array
    {
        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre
        // Einzelteile zerlegt.
        // /User/index/foo --> ['User', 'index', 'foo']
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?'); // Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/'); // Alle / am Anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); // In Einzelteile zerlegen

        return $uriFragments;
    }
}
