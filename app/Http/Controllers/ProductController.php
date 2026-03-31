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
            'product' => Product::findOrFail($id),
            'otherProducts' => Product::limit(10)
                ->whereNot('id', '=', $id)
                ->get()
        ]);
    }
}
