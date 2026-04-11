<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ProductController extends Controller
{
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

        $minPrice = $request->query('price-min');
        if ($minPrice !== null && $minPrice !== '' && is_numeric($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        $maxPrice = $request->query('price-max');
        if ($maxPrice !== null && $maxPrice !== '' && is_numeric($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        $brand = $request->query('brand');
        if ($brand !== null && $brand !== '' && $brand !== 'all') {
            $query->whereHas('brand', function ($brandQuery) use ($brand) {
                $brandQuery->whereRaw('LOWER(name) = ?', [strtolower($brand)]);
            });
        }

        $color = $request->query('color');
        if (
            $color !== null &&
            $color !== '' &&
            $color !== 'all' &&
            Schema::hasColumn('Product', 'color')
        ) {
            $query->whereRaw('LOWER(color) = ?', [strtolower($color)]);
        }

        $sortMap = [
            'price-asc' => ['price', 'asc'],
            'price-desc' => ['price', 'desc'],
            'name-asc' => ['name', 'asc'],
        ];
        $sortOrder = $request->query('sort-order', 'price-asc');
        [$sortColumn, $sortDirection] = $sortMap[$sortOrder] ?? $sortMap['price-asc'];
        $query->orderBy($sortColumn, $sortDirection);

        return view('product-list', [
            'heading' => 'All Products',
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => []
        ]);
    }
}
