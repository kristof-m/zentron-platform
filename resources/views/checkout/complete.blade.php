<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="checkout complete"/>
    @vite('resources/css/style.css')
    @vite('resources/css/form.css')
    @vite('resources/css/checkout.css')
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
