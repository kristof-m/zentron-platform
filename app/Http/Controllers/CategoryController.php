<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $id, ?int $pageNumber = 1): View
    {
        return view('product-list', [
            'heading' => Category::findOrFail($id)->name,
            'pageNumber' => $pageNumber,
            'products' => Category::with('products')
                ->findOrFail($id)
                ->products()
                ->with('categories')
                ->get()
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('categories', [
            'categories' => Category::all()
        ]);
    }
}
