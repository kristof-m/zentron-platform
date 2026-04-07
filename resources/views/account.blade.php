<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/auth.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron account page"/>
    <title>zentron - account</title>
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
