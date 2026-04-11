<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilteringController;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    use FilteringController;

    public function show(Request $request, string $id, ?int $pageNumber = 1): View
    {
        $brand = Brand::with('products')
            ->findOrFail($id);

        $query = $brand->products()
            ->with('categories')
            ->get();

        $query = $this->filterQuery($request, $query);

        return view('product-list', [
            'heading' => $brand->name,
            'pageNumber' => $pageNumber,
            'products' => $query->paginate(20)->withQueryString(),
            'hiddenFields' => ['brand']
        ]);
    }

    public function all(?int $pageNumber = 1): View
    {
        return view('brands', [
            'brands' => Brand::all()
        ]);
    }
}
