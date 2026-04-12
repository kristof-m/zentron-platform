<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/product.css')
    @vite('resources/js/product-amount.ts')
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
            @if($product->brand != null)
                <a class="black-link brand-name" href="/brand/{{ $product->brand->id }}">
                    {{ $product->brand->name }}<span aria-hidden="true"> > </span>
                </a>
            @endif

            <div class="tags">
                @foreach($product->categories as $category)
                    <a class="tag black-link" href="/category/{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            <div class="spacer" aria-hidden="true"></div>
            <p class="main-price">{{ $product->price }} €</p>
        </div>
        <div class="product-col">
            <h2>Free delivery</h2>
            <p>Expected Mar 18-20</p>

            <form class="cart-row" method="post" action="/cart/setAmount">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}"/>
                <button type="button" id="amount-minus" class="cart-btn">-</button>
                <input class="amount-field" id="amount-field" type="number" name="amount" value="1"/>
                <button type="button" id="amount-plus" class="cart-btn">+</button>
                <div class="cart-row-spacer" aria-hidden="true"></div>
                <button type="submit" class="cart-btn">Add to cart</button>
            </form>
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
