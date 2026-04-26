<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="account"/>
    @vite('resources/css/style.css')
    @vite('resources/css/auth.css')
</head>

<body>

@include('components.header')

<main>
    <h1>Hi, {{ $user->name }}</h1>
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
