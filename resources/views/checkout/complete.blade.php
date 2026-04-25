<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/form.css')
    @vite('resources/css/checkout.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron checkout completion page"/>
    <title>zentron - checkout complete</title>
</head>

<body class="checkout-page">

@include('components.header')

<main class="checkout-main">
    <h1>Order complete</h1>

    <a class="checkout-link" href="/">Go home</a>
    <a class="checkout-link" href="/orders">View orders</a>
</main>

</body>
</html>
