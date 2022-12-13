<?php

namespace App\Controllers;

use App\Products;

class ProductsController extends Controller
{
    private $productsObj;
    // public function __construct($app)
    // {
    //     parent::__construct($app);
    //     $this->productsObj = new Products($this->app->path('database/products.json'));
    // }

    public function index()
    {
        // $products = $this->productsObj->getAll();
        $products = $this->app->db()->all('products');
        return $this->app->view('products/index', ['products' => $products]);
    }

    public function show()
    {
        $sku = $this->app->param('sku');
        if (is_null($sku)) {
            $this->app->redirect('/products');
        }
        // $product = $this->productsObj->getBySku($sku);
        $product = $this->app->db()->findByColumn('products', 'sku', '=', $sku);
        if (empty($product)) {
            return $this->app->view('products/missing');
        }
        $product = $product[0];
        $reviewSaved = $this->app->old('reviewSaved');

        $reviews = $this->app->db()->findByColumn('reviews', 'product_id', '=', $product['id']);
        return $this->app->view('products/show', [
            'product' => $product,
            'reviews' => $reviews,
            'reviewSaved' => $reviewSaved
        ]);
    }

    public function saveReview()
    {
        $this->app->validate([
            'product_id' => 'product_id',
            'sku' => 'required',
            'name' => 'required',
            'review' => 'required|minLength:200'
        ]);

        $sku = $this->app->input('sku');
        $product_id = $this->app->input('product_id');
        $name = $this->app->input('name');
        $review = $this->app->input('review');

        # save into db
        $this->app->db()->insert('reviews', [
            'product_id'   => $product_id,
            'name'  => $name,
            'review' => $review,
        ]);

        return $this->app->redirect('/product?sku=' . $sku, ['reviewSaved' => true]);
    }
}
