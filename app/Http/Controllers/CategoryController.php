<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $id, ?int $pageNumber = 1): View
    {
        $category = Category::findOrFail($id);

        return view('product-list', [
            'heading' => $category->name,
            'pageNumber' => $pageNumber,
            'products' => $category
                ->products()
                ->with('categories')
                ->get()
        ]);
    }
// 'All' pagination causes type error
    public function all(?int $pageNumber = 1): View
    {
        return view('categories', [
            'categories' => Category::all()
        ]);
    }
}
