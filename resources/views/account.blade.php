<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="account"/>
    @vite('resources/css/style.css')
    @vite('resources/css/menu.css')
</head>

<body>

@include('components.header')

<main class="main">
    <h1>Hi, {{ $user->name }}</h1>
    <a href="{{ route('orders') }}" class="menu-btn">
        My orders
    </a>
    @if ($user->isAdmin())
        <a href="{{ route('admin.home') }}" class="menu-btn">
            Admin tools
        </a>
    @endif
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="menu-btn">
            Sign out
        </button>
    </form>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
