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
        $view = $this->getView();
        $view->content = "<h1>Error 404</h1><br><p>Page not found</p><br><img src='http://" . $_SERVER["SERVER_NAME"] . "/img/PageNotFoundSmiley.JPG' alt='error404'>";
    }
}