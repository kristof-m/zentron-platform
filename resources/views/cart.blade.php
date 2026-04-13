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
                    <a class="black-link item-name" href="/product/{{ $product->id }}">
                        <h2>{{ $product->name }}</h2>
                    </a>
                </div>

                <div class="item-controls">
                    <div class="amount-controls">
                        @if ($amounts[$product->id] > 1)
                            <form method="post" action="/cart/setAmount">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}"/>
                                <input type="hidden" name="amount" value="{{ $amounts[$product->id] - 1 }}"/>
                                <button class="icon-button">-</button>
                            </form>
                        @else
                            <button class="icon-button" aria-disabled="true">-</button>
                        @endif
                        <form method="post" action="/cart/setAmount">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}"/>
                            <input class="item-amount" type="number" name="amount" size="2"
                                   value="{{ $amounts[$product->id] }}"/>
                            <input type="submit" hidden>
                        </form>
                        <form method="post" action="/cart/setAmount">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}"/>
                            <input type="hidden" name="amount" value="{{ $amounts[$product->id] + 1 }}"/>
                            <button class="icon-button">+</button>
                        </form>
                    </div>

                    <form method="post" action="/cart/remove">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}"/>
                        <button class="icon-button" type="submit">
                            <img
                                src="{{ Vite::asset('resources/icons/X.svg') }}"
                                alt="Remove"
                                class="remove-icon"
                            />
                        </button>
                    </form>

                    <p class="price">{{ $amounts[$product->id] * $product->price }} €</p>
                </div>
            </article>
        @endforeach
    </div>

    <div class="payment-col">
        <p class="price-row">
            <span>Price:</span>
            <span>{{ $totalPrice }} €</span>
        </p>
        <p class="price-row">
            <span>Delivery fee:</span>
            <span>4.99 €</span>
        </p>
        <p class="price-row total-price">
            <span>Total:</span>
            <span>{{ $totalPrice + 4.99 }} €</span>
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
