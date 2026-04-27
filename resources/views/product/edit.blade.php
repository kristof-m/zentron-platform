<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/style.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/form.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron create product page"/>
    <title>zentron - new product</title>
</head>

<body class="admin-page">

@include('admin.header')

<h1 class="page-title">{{ $create ? 'New product' : 'Editing '.$product->name }}</h1>

@php
    $nameValue = old('name', $create ? '' : $product->name);
    $priceValue = old('price', $create ? '' : $product->price);
    $colorValue = old('color', $create ? '' : $product->color);
    $descriptionValue = old('description', $create ? '' : $product->description);
    $brandValue = old('brand_id', $create ? '' : ($product->brand_id ?? ''));
    $primaryImageUrl = old('image_url_primary', $create ? '' : ($product->image_url_primary ?? ''));
    $secondaryImageUrl = old('image_url_secondary', $create ? '' : ($product->image_url_secondary ?? ''));
@endphp

<main>
    <form class="form" action="{{ $create ? route('product.create') : route('product.update', [$product]) }}"
          method="post">
        @csrf
        <div class="field-row">
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ $nameValue }}" placeholder="Xbox Series X White"/>
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="price">Price</label>
            <input type="number" step=".01" id="price" name="price" value="{{ $priceValue }}"
                   placeholder="149.99"/>
            @error('price')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="color">Color</label>
            <input id="color" name="color" value="{{ $colorValue }}"
                   placeholder="White"/>
            @error('color')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="desc">Description</label>
            <textarea id="desc" type="text" name="description"
                      placeholder="Enter description here...">{{ $descriptionValue }}</textarea>
            @error('description')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="brand">Brand</label>
            <select id="brand" name="brand_id">
                <option value="" {{ (string) $brandValue === '' ? 'selected' : '' }}>[None]</option>
                @foreach($brands as $brand)
                    <option
                        value="{{ $brand->id }}" {{ (string) $brandValue === (string) $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="image-url-primary">Primary image URL</label>
            <input
                id="image-url-primary"
                name="image_url_primary"
                type="url"
                value="{{ $primaryImageUrl }}"
                placeholder="https://example.com/images/product-main.jpg"
            />
            @error('image_url_primary')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-row">
            <label for="image-url-secondary">Secondary image URL</label>
            <input
                id="image-url-secondary"
                name="image_url_secondary"
                type="url"
                value="{{ $secondaryImageUrl }}"
                placeholder="https://example.com/images/product-secondary.jpg"
            />
            @error('image_url_secondary')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        @if($primaryImageUrl !== '' || $secondaryImageUrl !== '')
            <div class="image-preview-grid" aria-label="Image URL previews">
                @if($primaryImageUrl !== '')
                    <figure class="image-preview-card">
                        <img src="{{ $primaryImageUrl }}" alt="Primary image preview" loading="lazy"/>
                        <figcaption>Primary preview</figcaption>
                    </figure>
                @endif
                @if($secondaryImageUrl !== '')
                    <figure class="image-preview-card">
                        <img src="{{ $secondaryImageUrl }}" alt="Secondary image preview" loading="lazy"/>
                        <figcaption>Secondary preview</figcaption>
                    </figure>
                @endif
            </div>
        @endif

        <button type="submit" class="register-btn">
            Save
        </button>
    </form>
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
