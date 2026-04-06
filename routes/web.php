<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::limit(10)->with('categories')->get();
    return view('index', ['products' => $products]);
});

Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/products/{page?}', [ProductController::class, 'all']);

Route::get('/category/{id}/{page?}', [CategoryController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'all']);

Route::get('/brand/{id}/{page?}', [BrandController::class, 'show']);
Route::get('/brands', [BrandController::class, 'all']);

Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/cart/setAmount', [CartController::class, 'setAmount']);
Route::post('/cart/remove', [CartController::class, 'remove']);
