<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="checkout complete"/>
    @vite('resources/css/style.css')
    @vite('resources/css/menu.css')
    @vite('resources/css/checkout.css')
</head>

<body class="checkout-page">

@include('components.header')

<main class="main">
    <h1>Order complete!</h1>
    <a class="menu-btn" href="/">Go home</a>
    <a class="menu-btn" href="/orders">View orders</a>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
