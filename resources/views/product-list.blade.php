<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron store - {{ $heading }} page {{ $pageNumber }}"/>
    <title>{{ $heading }} - page {{ $pageNumber  }} - zentron</title>
</head>

<body>
@include('components.header')

<h1 class="page-title">{{ $heading }}</h1>

<section class="filter-bar" aria-label="List controls">
    <form class="catalog-controls" action="#" method="get">
        <div>
            <label for="sort-order-category">Sort by</label>
            <select id="sort-order-category" name="sort-order">
                <option value="price-asc">Price: low to high</option>
                <option value="price-desc">Price: high to low</option>
                <option value="name-asc">Name: A-Z</option>
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
                placeholder="2000"
            />
        </div>

        <div>
            <label for="brand-category">Brand</label>
            <select id="brand-category" name="brand">
                <option value="all">All</option>
                <option value="sony">Sony</option>
                <option value="apple">Apple</option>
                <option value="valve">Valve</option>
            </select>
        </div>

        <div>
            <label for="color-category">Color</label>
            <select id="color-category" name="color">
                <option value="all">All</option>
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="gray">Gray</option>
            </select>
        </div>
    </form>

    <div class="spacer" aria-hidden="true"></div>

    <p class="icon-button" aria-disabled="true">
        <img
            src="{{ Vite::asset('resources/icons/arrow_left.svg') }}"
            alt="Previous page unavailable"
        />
    </p>
    <?php
        #TODO update placeholder pagination
    ?>
    <p class="page-info">Page {{ $pageNumber }} of 2</p>
    <a class="icon-button" href="/category/consoles/2.html">
        <img src="{{ Vite::asset('resources/icons/arrow_right.svg') }}" alt="Next page"/>
    </a>
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
