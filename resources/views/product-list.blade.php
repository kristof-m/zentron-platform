<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/js/filter.ts')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron store - {{ $heading }} page {{ $products->currentPage() }}"/>
    <title>{{ $heading }} - page {{ $products->currentPage() }} - zentron</title>
</head>

<body>
@include('components.header')

<h1 class="page-title">{{ $heading }}</h1>

@php
    $selectedSort = request()->query('sort-order', 'price-asc');
    $selectedMinPrice = request()->query('price-min', '');
    $selectedMaxPrice = request()->query('price-max', '');
    $selectedBrand = request()->query('brand', 'all');
    $selectedColor = request()->query('color', 'all');
@endphp

<section class="filter-bar" aria-label="List controls">
    <form class="catalog-controls" action="#" method="get">
        <div>
            <label for="sort-order-category">Sort by</label>
            <select id="sort-order-category" name="sort-order">
                <option value="price-asc" {{ $selectedSort === 'price-asc' ? 'selected' : '' }}>Price: low to high
                </option>
                <option value="price-desc" {{ $selectedSort === 'price-desc' ? 'selected' : '' }}>Price: high to low
                </option>
                <option value="name-asc" {{ $selectedSort === 'name-asc' ? 'selected' : '' }}>Name: A-Z</option>
            </select>
        </div>

        <div>
            <label for="price-min-category">Price from</label>
            <input
                id="price-min-category"
                class="price-field"
                name="price-min"
                type="number"
                min="0"
                step="1"
                value="{{ $selectedMinPrice }}"
                placeholder="0"
            />
        </div>

        <div>
            <label for="price-max-category">Price to</label>
            <input
                id="price-max-category"
                class="price-field"
                name="price-max"
                type="number"
                min="0"
                step="1"
                value="{{ $selectedMaxPrice }}"
                placeholder="2000"
            />
        </div>

        @if (!in_array('brand', $hiddenFields))
            <div>
                <label for="brand-category">Brand</label>
                <select id="brand-category" name="brand">
                    <option value="all" {{ $selectedBrand === 'all' ? 'selected' : '' }}>All</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $selectedBrand === $brand->name ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <label for="color-category">Color</label>
            <select id="color-category" name="color">
                <option value="all" {{ $selectedColor === 'all' ? 'selected' : '' }}>All</option>
                <option value="black" {{ $selectedColor === 'black' ? 'selected' : '' }}>Black</option>
                <option value="white" {{ $selectedColor === 'white' ? 'selected' : '' }}>White</option>
                <option value="gray" {{ $selectedColor === 'gray' ? 'selected' : '' }}>Gray</option>
            </select>
        </div>

        <div>
            <button class="apply-button" type="submit">Apply</button>
        </div>
    </form>

    <div class="spacer" aria-hidden="true"></div>

    @if($products->onFirstPage())
        <p class="icon-button" aria-disabled="true">
            <img
                src="{{ Vite::asset('resources/icons/arrow_left.svg') }}"
                alt="Previous page unavailable!"
            />
        </p>
    @else
        <a class="icon-button" href="{{$products->previousPageUrl()}}" aria-label="Previous page">
            <img src="{{Vite::asset('resources/icons/arrow_left.svg')}}" alt="Previous page"/>
        </a>
    @endif

    <p class="page-info">Page {{$products->currentPage()}} of {{$products->lastPage()}}</p>

    @if($products->hasMorePages())
        <a class="icon-button" href="{{$products->nextPageUrl()}}" aria-label="Next page">
            <img src="{{ Vite::asset('resources/icons/arrow_right.svg') }}" alt="Next page"/>
        </a>
    @else
        <p class="icon-button" aria-disabled="true">
            <img src="{{Vite::asset('resources/icons/arrow_right.svg')}}" alt="Next page unavailable!"/>
        </p>
    @endif
</section>

<main class="products">
    @foreach($products as $product)
        <x-product-card :product="$product"/>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')
</body>
</html>
