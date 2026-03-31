<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::limit(10)->with('categories')->get();
    return view('index', ['products' => $products]);
});

Route::get('/product/{id}', [ProductController::class, 'show']);
