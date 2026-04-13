<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilteringController;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    use FilteringController;

    public function search(Request $request, ?int $pageNumber = 1): View
    {
        $searchQuery = $request->query('q');
        $query = Product::search($searchQuery);

        $query = $this->filterQuery($request, $query)
            ->query(fn(Builder $query) => $query->with('categories'));

        $brands = $query->get()
            ->flatMap(fn(Product $prod) => $prod
                ->brand()->get())
            ->unique();

        return view('product-list', [
            'heading' => 'Search results for "' . $searchQuery . '"',
            'pageNumber' => $pageNumber,
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
        ]);
    }
}
