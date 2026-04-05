<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/cart.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron shopping cart"/>
    <title>zentron - cart</title>
</head>

<body>

@include('components.header')

<main class="cart-main">
    <div class="items-col">
        @foreach($products as $product)
            <article class="cart-item">
                <div class="item-display">
                    <img
                        src="assets/ps5.jpg"
                        alt="{{ $product->name }}"
                        width="512"
                        height="512"
                        class="item-image"
                    />
                    <a class="black-link item-name" href="/product/1.html">
                        <h2>{{ $product->name }}</h2>
                    </a>
                </div>

                <div class="item-part2">
                    <div class="amount-controls">
                        <button class="icon-button">-</button>
                        <p class="item-amount">{{ $amounts[$loop->index] }}</p>
                        <button class="icon-button">+</button>
                    </div>

                    <button class="icon-button" type="button">
                        <img
                            src="{{ Vite::asset('resources/icons/X.svg') }}"
                            alt="Remove"
                            class="remove-icon"
                        />
                    </button>

                    <p class="price">{{ $product->price }} €</p>
                </div>
            </article>
        @endforeach
    </div>

    <div class="payment-col">
        <p class="price-row">
            <span>Price:</span>
            <span>1996 €</span>
        </p>
        <p class="price-row">
            <span>Delivery fee:</span>
            <span>4.99 €</span>
        </p>
        <p class="price-row total-price">
            <span>Total:</span>
            <span>2000.99 €</span>
        </p>
        <div class="spacer" aria-hidden="true"></div>
        <a href="/checkout.html" class="black-link checkout-link">
            Checkout
        </a>
    </div>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
