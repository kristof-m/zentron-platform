<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Request $request, string $id): View
    {
        $category = Category::findOrFail($id);

        $query = $category
            ->products()
            ->with('categories');

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
        if ($color !== null && $color !== '' && $color !== 'all' && Schema::hasColumn('Product', 'color')) {
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
            'heading' => $category->name,
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => []
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
