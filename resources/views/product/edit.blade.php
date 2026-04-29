<!doctype html>
<html lang="en">
<head>
    <x-meta-tags :title="$create ? 'new product' : 'edit product'"/>
    @vite('resources/css/style.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/form.css')
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
@endphp

<main>
    <form class="form" action="{{ $create ? route('product.create') : route('product.update', [$product]) }}"
          method="post" enctype="multipart/form-data">
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
            <label for="image">Add image</label>
            <input
                id="image"
                name="image"
                type="file"
                accept="image/png, image/jpg, image/webp, image/avif"
            />
            @error('image')
            <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        @if ($product->hasMedia('images'))
            <div class="image-preview-grid" aria-label="Image URL previews">
                @foreach ($product->getMedia('images') as $image)
                    <figure class="image-preview-card">
                        <img src="{{ $image->getUrl() }}" alt="Product image preview" loading="lazy"/>
                        <figcaption>Secondary preview</figcaption>
                    </figure>
                @endforeach
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
