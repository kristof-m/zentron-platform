<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use ControllerWithProducts;
    public const PRODUCTS_PER_PAGE = 10;
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
            'products' => $query->paginate(self::PRODUCTS_PER_PAGE)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('categories', [
            'categories' => Category::all()
        ]);
    }

    public function create(Request $request)
    {
        Gate::authorize('create', Category::class);
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::create($validated);

        return redirect(route('category.show', [$category]));
    }

    public function new(): View
    {
        return view('category.edit', [
            'create' => true,
        ]);
    }

    public function update(Category $category, Request $request)
    {
        Gate::authorize('update', $category);
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($validated);

        return redirect(route('category.show', [$category]));
    }

    public function edit(Category $category): View
    {
        return view('category.edit', [
            'create' => false,
            'category' => $category,
        ]);
    }
}
