<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use ControllerWithProducts;

    public function show(Request $request, string $id): View
    {
        $category = Category::findOrFail($id);

        $query = $category
            ->products()
            ->with(['categories']);

        $brands = $this->getBrands($query);
        $colors = $this->getColors($query);
        $query = $this->filterQuery($request, $query);

        $minPrice = intval($query->min('price'));
        $maxPrice = round($query->max('price'), 0, PHP_ROUND_HALF_UP);

        return view('product-list', [
            'heading' => $category->name,
            'products' => $query->paginate(10)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
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
