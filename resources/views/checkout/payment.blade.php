<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/form.css')
    @vite('resources/css/checkout.css')
    @vite('resources/css/payment.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron payment page"/>
    <title>zentron - payment</title>
</head>

<body class="checkout-page">

@include('components.header')

<x-checkout-stepper step="payment"/>

<form class="checkout-main" action="/checkout/acceptPayment" method="post">
    <section
        class="checkout-layout"
        aria-label="Checkout payment layout"
    >
        <section
            class="checkout-form-box payment-box"
            aria-label="Payment section"
        >
            <h2>Payment method</h2>

            <div class="payment-form">
                <fieldset
                    class="payment-methods"
                    aria-label="Payment method selector"
                    disabled
                >
                    <label class="payment-option">
                        <input type="radio" name="payment-method"/>
                        <span>Google Pay</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method"/>
                        <span>Apple Pay</span>
                    </label>
                    <label class="payment-option">
                        <input
                            type="radio"
                            name="payment-method"
                            checked
                        />
                        <span>Credit/Debit Card</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method"/>
                        <span>Bank transfer</span>
                    </label>
                </fieldset>

                <label for="card-no">Card No:</label>
                <input
                    id="card-no"
                    name="card-no"
                    type="text"
                    placeholder="0000 0000 0000 0000"
                    autocomplete="cc-number"
                />

                <div class="payment-row payment-row-split">
                    <div>
                        <label for="card-cvc">CVC:</label>
                        <input
                            id="card-cvc"
                            name="card-cvc"
                            type="text"
                            placeholder="123"
                            autocomplete="cc-csc"
                        />
                    </div>
                    <div>
                        <label for="card-exp">Expires:</label>
                        <input
                            id="card-exp"
                            name="card-exp"
                            type="text"
                            placeholder="MM / YY"
                            autocomplete="cc-exp"
                        />
                    </div>
                </div>
            </div>
        </section>

        <x-checkout-summary :order="$order" forward-text="Confirm payment" back-link="/checkout/review"/>
    </section>
</form>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
