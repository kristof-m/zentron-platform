<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="brands"/>
    @vite('resources/css/style.css')
    @vite('resources/css/categories.css')
</head>

<body>
@include('components.header')

<main class="categories-main">
    @foreach($brands as $brand)
        <article class="category-box">
            <a class="category" href="/brand/{{ $brand->id }}">
                <h2>{{ $brand->name }}</h2>
            </a>
            @can('update', $brand)
                <a class="category edit-section" href="{{ route('brand.edit', [$brand]) }}">Edit</a>
            @endcan
        </article>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
