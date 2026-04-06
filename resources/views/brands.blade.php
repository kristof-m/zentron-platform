<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/categories.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron - brands"/>
    <title>brands - zentron</title>
</head>

<body>
@include('components.header')

<main class="categories-main">
    @foreach($brands as $brand)
        <article class="category-box">
            <a class="category" href="/brand/{{ $brand->id }}">
                <h2>{{ $brand->name }}</h2>
            </a>
        </article>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
