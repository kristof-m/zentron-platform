<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="cart"/>
    @vite('resources/css/style.css')
    @vite('resources/css/cart.css')
</head>

<body>

@include('components.header')

<main class="cart-main">
    <div class="items-col">
        @foreach($products as $product)
            <article class="cart-item">
                <div class="item-display">
                    <img
                        src="{{ $product->imageUrl() }}"
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
                    <div class="price-box">
                        <p class="price">{{ number_format($amounts[$product->id] * $product->price, 2) }} €</p>
                        <p class="price-piece">{{ number_format($product->price, 2) }} €</p>
                    </div>
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
        @if($products->isEmpty())
            <p class="checkout-link checkout-link-disabled" aria-disabled="true">
                Checkout
            </p>
        @else
            <a href="{{ route('checkout') }}" class="black-link checkout-link">
                Checkout
            </a>
        @endif
    </div>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
