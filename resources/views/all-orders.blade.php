@php use App\Enums\OrderStatus; @endphp
    <!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="orders"/>
    @vite('resources/css/style.css')
    @vite('resources/css/all-orders.css')
</head>

<body>

@include('components.header')

<main>
    @foreach($orders as $order)
        <article>
            <a href="/order/{{ $order->id }}" class="order-link">
                <h2>#{{ $order->id }}</h2>
                <p class="order-status">
                    @switch ($order->status)
                        @case(OrderStatus::InCart->value)
                            🛒 In Cart
                            @break
                        @case(OrderStatus::Confirmed->value)
                            ✅ Confirmed
                            @break
                        @case(OrderStatus::Paid->value)
                            💸 Paid
                            @break
                        @case(OrderStatus::Shipped->value)
                            ✈️ Shipped
                            @break
                        @default
                    @endswitch
                </p>

                <p>{{ $order->total_amount }} €</p>

                <p>{{ $order->updated_at }}</p>
            </a>
        </article>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
