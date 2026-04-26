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
    @foreach($user->orders()->orderBy('created_at')->get() as $order)
        <article>
            <a href="/order/{{ $order->id }}" class="order-link">
                <h2>#{{ $order->id }}</h2>
                @switch ($order->status)
                    @case(OrderStatus::InCart->value)
                        <p>🛒 In Cart</p>
                        @break
                    @case(OrderStatus::Confirmed->value)
                        <p>✅ Confirmed</p>
                        @break
                    @case(OrderStatus::Paid->value)
                        <p>💸 Paid</p>
                        @break
                    @case(OrderStatus::Shipped->value)
                        <p>✈️ Shipped</p>
                        @break
                    @default
                @endswitch

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
