<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::limit(10)->with('categories')->get();
    return view('index', ['products' => $products]);
});

Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'all']);

Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'all']);

Route::get('/brand/{id}/{page?}', [BrandController::class, 'show']);
Route::get('/brands', [BrandController::class, 'all']);

Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::post('/cart/setAmount', [CartController::class, 'setAmount']);
Route::post('/cart/remove', [CartController::class, 'remove']);

Route::get('/account', [UserController::class, 'account'])->middleware('auth');

Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::get('/admin/home', function () {
    $user = auth()->user();
    return view('admin.home', compact('user'));
})->can('create', Product::class)->name('admin.home');
