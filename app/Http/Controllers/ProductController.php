<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ControllerWithProducts;

    public function show(string $id): View
    {
        return view('product', [
            'product' => Product::with('categories')
                ->with('brand')
                ->findOrFail($id),
            'otherProducts' => Product::limit(10)
                ->whereNot('id', '=', $id)
                ->with('categories')
                ->get()
        ]);
    }

    public function all(Request $request): View
    {
        $query = Product::with('categories');

        $brands = $this->getBrands($query);
        $colors = $this->getColors($query);
        $query = $this->filterQuery($request, $query);

        return view('product-list', [
            'heading' => 'All Products',
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
        ]);
    }
}
