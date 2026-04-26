@php use App\Enums\OrderStatus; @endphp
    <!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="order #{{ $order->id }}"/>
    @vite('resources/css/style.css')
    @vite('resources/css/order.css')
</head>

<body>

@include('components.header')

<main>
    <h1>Order #{{ $order->id }}</h1>

    <p>Created at: {{ $order->created_at }}</p>
    <p>Updated at: {{ $order->updated_at }}</p>

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

    <p class="total-price">Total: {{ $order->total_amount }} €</p>

    <h2>Shipping details</h2>
    <table class="details-box">
        <tbody>
        <tr>
            <td>Address:</td>
            <td>{{$order->address_1}}</td>
        </tr>
        @if ($order->address_2)
            <tr>
                <td>Address 2:</td>
                <td>{{$order->address_2}}</td>
            </tr>
        @endif
        <tr>
            <td>Postal Code:</td>
            <td>{{$order->zip}}</td>
        </tr>
        @if ($order->city)
            <tr>
                <td>City:</td>
                <td>{{$order->city}}</td>
            </tr>
        @endif
        <tr>
            <td>Country:</td>
            <td>{{$order->country}}</td>
        </tr>
        </tbody>
    </table>

    <h2>Contact info</h2>
    <table class="details-box">
        <tbody>
        <tr>
            <td>Name:</td>
            <td>{{ $order->contact_name }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $order->contact_email }}</td>
        </tr>
        @if ($order->contact_phone)
            <tr>
                <td>Phone:</td>
                <td>{{ $order->contact_phone }}</td>
            </tr>
        @endif
        </tbody>
    </table>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
