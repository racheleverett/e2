<?php

namespace App\Controllers;

use App\Products;

class ProductsController extends Controller
{
    private $productsObj;
    public function __construct($app)
    {
        parent::__construct($app);
        $this->productsObj = new Products($this->app->path('database/products.json'));
    }

    public function index()
    {
        $products = $this->productsObj->getAll();
        return $this->app->view('products/index', ['products' => $products]);
    }

    public function show()
    {
        $sku = $this->app->param('sku');
        if (is_null($sku)) {
            $this->app->redirect('/products');
        }
        $product = $this->productsObj->getBySku($sku);
        if (is_null($product)) {
            return $this->app->view('products/missing');
        }
        $reviewSaved = $this->app->old('reviewSaved');
        return $this->app->view('products/show', ['product' => $product, 'reviewSaved' => $reviewSaved]);
    }

    public function saveReview()
    {
        $this->app->validate([
            'sku' => 'required',
            'name' => 'required',
            'review' => 'required|minLength:200'
        ]);

        $sku = $this->app->input('sku');
        $name = $this->app->input('name');
        $review = $this->app->input('review');

        # save into db

        return $this->app->redirect('/product?sku=' . $sku, ['reviewSaved' => true]);
    }
}
