<?php
namespace App\Controller;
use App\View\View;

class PageNotFoundController
{

    private $view;
    /**
     * PageNotFoundController constructor.
     * @param View  $view   The view
     */
    public function __construct(View $view)
    {
        $this->setView($view);
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @param View $view
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function index() {
        echo "<h1>Error 404</h1><br><h2>Page not found</h2><br><img src='../../public/img/PageNotFoundSmiley.JPG'>";
    }
}