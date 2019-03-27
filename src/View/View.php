<?php

namespace App\View;
class View
{
    private $properties = array();
    private $viewFile;

    public function __construct($viewFile)
    {
        $this->viewFile = "../template/" . $viewFile . ".php";
    }

    public function display() : void {

        extract($this->properties);
        require "../template/header.php";

        require $this->viewFile;

        require "../template/nav.php";
        require "../template/footer.php";
    }

    public function __set($key, $value)
    {
        if (!isset($this->properties[$key])) {
            $this->properties[$key] = $value;
        }
    }

    public function __get($key)
    {
        return $this->properties[$key];
    }
}
