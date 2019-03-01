<?php

namespace App\Dispatcher;

class UriParser
{
    /**
     * Diese Methode wertet die Request URI aus und gibt den Controllername zurück.
     */
    public static function getControllerName()
    {
		$uriFragments = self::getUriFragments();
		// TODO: Methode um den "Controller"-Teil der URI zurückzugeben
        // http://my-project.local/default/index    ->      "default"
        // http://my-project.local/user/create      ->      "user"
        // http://my-project.local                  ->      "default"

        if (!empty($uriFragments[0]) && class_exists(ucfirst($uriFragments[0]).'Controller')) {
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
    public static function getMethodName()
    {
		$uriFragments = self::getUriFragments();
		// TODO: Methode um den "Action"-Teil der URI zurückzugeben
        // http://my-project.local/default/index    ->      "index"
        // http://my-project.local/user/create      ->      "create"
        // http://my-project.local                  ->      "index"

        if (!empty($uriFragments[1])) {
            return $uriFragments[1];
        }
        else {
            return 'index';
        }
    }

    private static function getUriFragments()
    {
        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre
        // Einzelteile zerlegt.
        // /user/index/foo --> ['user', 'index', 'foo']
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?'); // Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/'); // Alle / am Anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); // In Einzelteile zerlegen

        return $uriFragments;
    }
}