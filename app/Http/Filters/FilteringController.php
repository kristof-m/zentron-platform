<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


trait FilteringController
{
    // Filters and sorts $query based on URL params in $request
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
        $query->orderBy($sortColumn, $sortDirection);

        return $query;
    }
}
