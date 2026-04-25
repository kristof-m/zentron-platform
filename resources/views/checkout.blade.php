<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/form.css')
    @vite('resources/css/checkout.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron checkout page"/>
    <title>zentron - checkout payment</title>
</head>

<body class="checkout-page">

@include('components.header')

<section class="checkout-steps" aria-label="Checkout steps">
    <ol class="checkout-stepper">
        <li class="step-item is-active">
            <span class="step-index" aria-hidden="true">1</span>
            <span class="step-label">Shipping</span>
        </li>
        <li class="step-item">
            <span class="step-index" aria-hidden="true">2</span>
            <span class="step-label">Review</span>
        </li>
        <li class="step-item" aria-current="step">
            <span class="step-index" aria-hidden="true">3</span>
            <span class="step-label">Payment</span>
        </li>
    </ol>
</section>

<main class="checkout-main">
    @if (auth()->guest())
        <section
            class="guest-signin-card"
            aria-label="Guest checkout sign-in option"
        >
            <p>
                Checking out as guest. Want to keep this order in your
                account?
            </p>
            <div class="checkout-link guest-signin-link">
                <a href="/login">Sign in and continue checkout</a>
            </div>
        </section>
    @endif

    <form class="checkout-layout" action="/checkout/setDetails" method="post">
        <section class="checkout-form-box" aria-label="Customer form">
            <h2>Customer details</h2>

            <div class="checkout-form">
                <label for="name">Contact name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    autocomplete="name"
                    placeholder="Peter Kováčik"
                />

                <label for="address-1">Address 1</label>
                <input
                    id="address-1"
                    name="address-1"
                    type="text"
                    autocomplete="address-line1"
                    placeholder="Bratislavská 10"
                />

                <label for="address-2">Address 2</label>
                <input
                    id="address-2"
                    name="address-2"
                    type="text"
                    autocomplete="address-line2"
                    placeholder="Apartment / floor (optional)"
                />

                <div class="field-row field-row-zip-city">
                    <div>
                        <label for="zip">ZIP code</label>
                        <input
                            id="zip"
                            name="zip"
                            type="text"
                            autocomplete="postal-code"
                            placeholder="04011"
                        />
                    </div>
                    <div>
                        <label for="city">City</label>
                        <input
                            id="city"
                            name="city"
                            type="text"
                            autocomplete="address-level1"
                            placeholder="Košice"
                        />
                    </div>
                </div>

                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="SK">Slovakia</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="AT">Austria</option>
                </select>

                <div class="field-row">
                    <label for="phone-number">Phone number</label>
                    <input
                        id="phone-number"
                        name="phone-number"
                        type="tel"
                        placeholder="+421 900 000 000"
                    />
                </div>

                <label for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    placeholder="name@email.com"
                />

                <fieldset class="delivery-methods">
                    <legend>Delivery method</legend>

                    <label class="delivery-option">
                        <input
                            type="radio"
                            name="delivery-method"
                            checked
                        />
                        <span>Home courier (2-3 business days)</span>
                        <span>6 EUR</span>
                    </label>

                    <label class="delivery-option">
                        <input type="radio" name="delivery-method"/>
                        <span>Pickup point (next day)</span>
                        <span>3 EUR</span>
                    </label>

                    <label class="delivery-option">
                        <input type="radio" name="delivery-method"/>
                        <span>Store pickup</span>
                        <span>0 EUR</span>
                    </label>
                </fieldset>

                <div class="checkbox-row">
                    <div>
                        <input id="terms" type="checkbox" checked/>
                        <label for="terms">Terms of Service</label>
                    </div>
                    <div>
                        <input id="subscribe" type="checkbox" checked/>
                        <label for="subscribe">
                            Subscribe to newsletter
                        </label>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="form-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>

        <aside class="checkout-summary" aria-label="Order summary">
            <h2>Order summary</h2>

            <p class="price-row">
                <span>Subtotal</span><span>{{ $order->total_amount }} €</span>
            </p>
            <p class="price-row">
                <span>Delivery</span><span>6 EUR</span>
            </p>
            <p class="price-row">
                <span>Tax</span><span>199 EUR</span>
            </p>

            <p class="price-row total-price">
                <span>Total:</span><span>1204 EUR</span>
            </p>

            <button class="checkout-link">
                Go to review
            </button>

            <div class="checkout-link">
                <a href="/cart">Go back</a>
            </div>
        </aside>
    </form>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
