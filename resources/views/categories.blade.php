<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="categories"/>
    @vite('resources/css/style.css')
    @vite('resources/css/categories.css')
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
