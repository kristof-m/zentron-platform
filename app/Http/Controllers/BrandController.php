<?php

namespace App\Http\Controllers;

use App\Http\Filters\ControllerWithProducts;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    use ControllerWithProducts;

    public function show(Request $request, string $id, ?int $pageNumber = 1): View
    {
        $brand = Brand::with('products')
            ->findOrFail($id);

        $query = $brand
            ->products()
            ->with('categories');

        $colors = $this->getColors($query);
        $query = $this->filterQuery($request, $query);

        return view('product-list', [
            'heading' => $brand->name,
            'pageNumber' => $pageNumber,
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => ['brand'],
            'colors' => $colors,
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('brands', [
            'brands' => Brand::all()
        ]);
    }
}
