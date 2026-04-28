<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    use ControllerWithProducts;

    public function search(Request $request, ?int $pageNumber = 1): View
    {
        $searchQuery = $request->query('q');
        $query = Product::search($searchQuery);

        $minPrice = intval($query->get()->min('price'));
        $maxPrice = round($query->get()->max('price'), 0, PHP_ROUND_HALF_UP);

        $query = $this->filterQuery($request, $query)
            ->query(fn(Builder $query) => $query->with('categories'));

        $brands = $this->getBrands($query);
        $colors = $this->getColors($query);

        return view('product-list', [
            'heading' => 'Search results for "' . $searchQuery . '"',
            'pageNumber' => $pageNumber,
            'products' => $query->paginate(10)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}
