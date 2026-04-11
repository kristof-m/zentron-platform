<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilteringController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use FilteringController;

    public function show(Request $request, string $id): View
    {
        $category = Category::findOrFail($id);

        $query = $category
            ->products()
            ->with('categories');

        $brands = $query->get()
            ->flatMap(fn(Product $prod) => $prod
                ->brand()->get())
            ->unique();

        $query = $this->filterQuery($request, $query);

        return view('product-list', [
            'heading' => $category->name,
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
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
