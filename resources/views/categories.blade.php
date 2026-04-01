<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/categories.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron - categories"/>
    <title>categories - zentron</title>
</head>

<body>
@include('components.header')

<main class="categories-main">
    @foreach($categories as $category)
        <article class="category-box">
            <a class="category" href="/category/{{ $category->id }}">
                <h2>{{ $category->name }}</h2>
            </a>
        </article>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
