<?php
namespace App\View;
class View{
    private $properties = array();
    private $viewFile;
    public function __construct($viewFile){
        $this->viewFile = "../template/" . $viewFile . ".php";
    }

    public function display() : void{
        require "../template/header.php";
        extract($this->properties);

        require $this->viewFile;

        require "../template/nav.php";
        require "../template/footer.php";
    }

    public function __set(string $key, string $value) : void{
        if(!isset($this->properties[$key])){
            $this->properties[$key] = $value;
        }
    }

    public function __get(string $key) : object {
        return $this->properties[$key];
    }


}