<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function show(Request $request): View
    {
        $entries = $request->session()->get('cartEntries', [2 => 1]);
        $products = Product::findMany(array_keys($entries));
        return view('cart', [
            'products' => $products,
            'amounts' => array_values($entries),
        ]);
    }
}
