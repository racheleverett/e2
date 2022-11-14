<?php

namespace App\Controllers;

class ProductsController extends Controller
{
    public function index()
    {
        return $this->app->view('products/index');
    }
}
