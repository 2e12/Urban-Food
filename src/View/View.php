<?php

namespace App\View;
class View
{
    private $properties = array();
    private $viewFile;

    /**
     * View constructor.
     * @param $viewFile View file
     */
    public function __construct($viewFile)
    {
        $this->viewFile = "../template/" . ucfirst($viewFile) . ".php";
    }

    /**
     * Lädt die verschiedenen HTML Dateien zusammen und zeigt sie an
     */
    public function display()
    {

        extract($this->properties);
        require "../template/header.php";

        require $this->viewFile;

        require "../template/nav.php";
        require "../template/footer.php";
    }

    /**
     * Setzt ein Wert auf eine Veriable
     * @param $key Der index
     * @param $value Der Inhalt
     */
    public function __set($key, $value)
    {
        if (!isset($this->properties[$key])) {
            $this->properties[$key] = $value;
        }
    }

    /**
     * Ruft einen Wert ab
     * @param $key Variabel index
     * @return mixed
     */
    public function __get($key)
    {
        return $this->properties[$key];
    }
}
