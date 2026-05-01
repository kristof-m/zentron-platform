<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="admin tools"/>
    @vite('resources/css/style.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/auth.css')
    @vite('resources/css/menu.css')
</head>

<body class="admin-page">

@include('admin.header')

<main class="main">
    <h1>Hi, {{ $user->name }}</h1>
    <p>You are an admin!</p>
    <a class="menu-btn" href="{{ route('admin.products') }}">Manage Products</a>
    <a class="menu-btn" href="{{ route('product.new') }}">Add new product</a>
    <a class="menu-btn" href="{{ route('category.new') }}">Add new category</a>
    <a class="menu-btn" href="{{ route('brand.new') }}">Add new brand</a>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="register-btn">
            Sign out
        </button>
    </form>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
