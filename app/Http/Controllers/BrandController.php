<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function show(string $id, ?int $pageNumber = 1): View
    {
        return view('product-list', [
            'heading' => Brand::findOrFail($id)->name,
            'pageNumber' => $pageNumber,
            'products' => Brand::with('products')
                ->findOrFail($id)
                ->products()
                ->get()
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('brands', [
            'brands' => Brand::all()
        ]);
    }
}
