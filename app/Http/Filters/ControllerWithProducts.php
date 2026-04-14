<?php

namespace App\Http\Filters;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as DbQuery;
use Laravel\Scout\Builder as ScoutQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;


trait ControllerWithProducts
{
    /** Filters and sorts $query based on URL params in `$request`
     * @return DbQuery|ScoutQuery
     */
    function filterQuery(Request $request, $query)
    {
        $minPrice = $request->query('price-min');
        if ($minPrice !== '' && is_numeric($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        $maxPrice = $request->query('price-max');
        if ($maxPrice !== '' && is_numeric($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        $brand = $request->query('brand');
        if ($brand !== null && $brand !== '' && $brand !== 'all') {
            $query->where('brand_id', $brand);
        }

        $color = $request->query('color');
        if ($color !== null && $color !== '' && $color !== 'all' && Schema::hasColumn('Product', 'color')) {
            $query->whereRaw('LOWER(color) = ?', [strtolower($color)]);
        }

        $sortMap = [
            'price-asc' => ['price', 'asc'],
            'price-desc' => ['price', 'desc'],
            'name-asc' => ['name', 'asc'],
        ];
        $sortOrder = $request->query('sort-order', 'price-asc');
        [$sortColumn, $sortDirection] = $sortMap[$sortOrder] ?? $sortMap['price-asc'];

        if ($sortColumn === 'name') {
            $query->orderByRaw('name collate ' . '"en-US-x-icu" ' . $sortDirection);
        } else {
            $query->orderBy($sortColumn, $sortDirection);
        }

        return $query;
    }

    /** Returns all brands present in $query
     * @return Collection<Brand>
     */
    function getBrands($query): Collection
    {
        return $query->get()
            ->flatMap(fn(Product $prod) => $prod
                ->brand()->get())
            ->unique();
    }

    /** Returns all colors present in $query
     * @return Collection<string>
     */
    function getColors($query): Collection
    {
        return $query->get()
            ->map(fn(Product $prod) => $prod->color)
            ->filter(fn(?string $color) => $color !== null)
            ->unique();
    }
}
