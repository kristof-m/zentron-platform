<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

        $minPrice = intval($query->min('price'));
        $maxPrice = round($query->max('price'), 0, PHP_ROUND_HALF_UP);

        return view('product-list', [
            'heading' => 'All Products',
            'products' => $query->paginate(10)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function create(Request $request)
    {
        Gate::authorize('create', Product::class);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:4095',
            'price' => 'required|numeric',
            'color' => 'nullable|string',
            'brand_id' => 'nullable|exists:Brand,id',
            'image_url_primary' => 'nullable|url|max:2048',
            'image_url_secondary' => 'nullable|url|max:2048',
        ]);

        $product = Product::create($validated);

        return redirect('/product/' . $product->id);
    }

    public function new(): View
    {
        $brands = Brand::all();

        return view('product.edit', [
            'create' => true,
            'brands' => $brands,
        ]);
    }

    public function update(Product $product, Request $request)
    {
        Gate::authorize('update', $product);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:4095',
            'price' => 'required|numeric',
            'color' => 'nullable|string',
            'brand_id' => 'nullable|exists:Brand,id',
            'image_url_primary' => 'nullable|url|max:2048',
            'image_url_secondary' => 'nullable|url|max:2048',
        ]);

        $product->update($validated);

        return redirect('/product/' . $product->id);
    }

    public function edit(Product $product): View
    {
        $brands = Brand::all();

        return view('product.edit', [
            'create' => false,
            'product' => $product->load('brand'),
            'brands' => $brands,
        ]);
    }

    public function adminIndex(Request $request): View
    {
        Gate::authorize('create', Product::class);

        $query = Product::with(['brand', 'categories']);

        $brands = $this->getBrands($query);
        $colors = $this->getColors($query);
        $query = $this->filterQuery($request, $query);

        return view('admin.products', [
            'heading' => 'Manage Products',
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => [],
            'brands' => $brands,
            'colors' => $colors,
        ]);
    }
}
