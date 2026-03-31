<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(string $id): View
    {
        return view('product', [
            'product' => Product::with('categories')
                ->findOrFail($id),
            'otherProducts' => Product::limit(10)
                ->whereNot('id', '=', $id)
                ->with('categories')
                ->get()
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('product-list', [
            'heading' => 'All Products',
            'pageNumber' => $pageNumber,
            'products' => Product::with('categories')
                ->limit(20)
                ->get()
        ]);
    }
}
