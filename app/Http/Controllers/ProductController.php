<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProductController extends Controller
{
    use ControllerWithProducts;

    public function show(string $id): View
    {
        $product = Product::with('categories')
            ->with(['brand', 'mainImage'])
            ->findOrFail($id);

        $imageUrls = $product->getMedia('images');

        Log::info('product images', ['images' => $imageUrls]);

        if ($imageUrls->isEmpty()) {
            $imageUrls = collect([$product->fallbackImageUrl()]);
        } else {
            $imageUrls = $imageUrls->map(fn($image) => $image->getUrl('hero'));
        }

        Log::info('product images', ['images' => $imageUrls]);

        return view('product', [
            'product' => $product,
            'imageUrls' => $imageUrls,
            'otherProducts' => Product::limit(10)
                ->whereNot('id', '=', $id)
                ->with(['categories', 'mainImage'])
                ->get()
        ]);
    }

    public function all(Request $request): View
    {
        $query = Product::with(['categories', 'mainImage']);

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
            'image' => 'required|file|image',
        ]);

        $product = Product::create($validated);
        $image = $request->file('image');

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
        ]);

        if ($request->file('image') !== null) {
            try {
                $product->addMediaFromRequest('image')
                    ->toMediaCollection('images');
            } catch (FileDoesNotExist|FileIsTooBig $e) {
                Log::error($e);
            }
        }

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

        $query = Product::with(['brand', 'categories', 'mainImage']);

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
