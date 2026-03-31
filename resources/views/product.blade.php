<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/product.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron store product page - {{ $product->name }}"/>
    <title>{{ $product->name }} - zentron</title>
</head>

<body>
@include('components.header')

<main>
    <div class="main-product">
        <img
            alt="{{ $product->name }}"
            class="main-image"
            src="../assets/ps5.jpg"
        />
        <div class="product-col">
            <h1>{{ $product->name }}</h1>
            <a class="black-link brand-name" href="#">Sony ></a>
            <div class="tags">
                <a class="tag black-link" href="/category/consoles.html"
                >Gaming</a
                >
                <a class="tag black-link" href="/category/consoles.html">
                    Consoles
                </a>
            </div>
            <div class="spacer" aria-hidden="true"></div>
            <p class="main-price">{{ $product->price }} €</p>
        </div>
        <div class="product-col">
            <h2>Free delivery</h2>
            <p>Expected Mar 18-20</p>

            <div class="cart-row">
                <button class="cart-btn">-</button>
                <p>1</p>
                <button class="cart-btn">+</button>
                <div class="cart-row-spacer" aria-hidden="true"></div>
                <button class="cart-btn">Add to cart</button>
            </div>
        </div>
    </div>

    <div class="product-desc">
        <h2>Description</h2>
        <p>
            {{ $product->description }}
        </p>
    </div>
</main>

<div class="products">
    @foreach($otherProducts as $product)
        <x-product-card :product="$product"/>
    @endforeach
</div>


@include('components.footer')

@include('components.mobile-nav')
</body>
</html>
