<?php

class ProductController
{
    public function index(): void
    {
        $view = new \App\View\View('Product/index');
        $view->title = 'Products';
        $view->display();
    }
}
