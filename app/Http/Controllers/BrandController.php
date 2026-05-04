<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BrandController extends Controller
{
    use ControllerWithProducts;
    public const PRODUCTS_PER_PAGE = 10;

    public function show(Request $request, string $id, ?int $pageNumber = 1): View
    {
        $brand = Brand::with('products')
            ->findOrFail($id);

        $query = $brand
            ->products()
            ->with(['categories']);

        $colors = $this->getColors($query);
        $query = $this->filterQuery($request, $query);

        $minPrice = intval($query->min('price'));
        $maxPrice = round($query->max('price'), 0, PHP_ROUND_HALF_UP);

        return view('product-list', [
            'heading' => $brand->name,
            'pageNumber' => $pageNumber,
            'products' => $query->paginate(self::PRODUCTS_PER_PAGE)->withQueryString(),
            'hiddenFields' => ['brand'],
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('brands', [
            'brands' => Brand::all()
        ]);
    }

    public function create(Request $request)
    {
        Gate::authorize('create', Brand::class);
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $brand = Brand::create($validated);

        return redirect(route('brand.show', [$brand]));
    }

    public function new(): View
    {
        return view('brand.edit', [
            'create' => true,
        ]);
    }

    public function update(Brand $brand, Request $request)
    {
        Gate::authorize('update', $brand);
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $brand->update($validated);

        return redirect(route('brand.show', [$brand]));
    }

    public function edit(Brand $brand): View
    {
        return view('brand.edit', [
            'create' => false,
            'brand' => $brand,
        ]);
    }
}
