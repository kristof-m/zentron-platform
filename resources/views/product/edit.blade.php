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

<main>
    <form class="form" action="{{ $create ? route('product.create') : route('product.update', [$product]) }}"
          method="post">
        @csrf
        <div class="field-row">
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ $create ? '' : $product->name }}" placeholder="Xbox Series X White"/>
        </div>
        <div class="field-row">
            <label for="price">Price</label>
            <input type="number" step=".01" id="price" name="price" value="{{ $create ? '' : $product->price }}"
                   placeholder="149.99"/>
        </div>
        <div class="field-row">
            <label for="color">Color</label>
            <input id="color" name="color" value="{{ $create ? '' : $product->color }}"
                   placeholder="White"/>
        </div>
        <div class="field-row">
            <label for="desc">Description</label>
            <textarea id="desc" type="text" name="description"
                      placeholder="Enter description here...">{{ $create ? '' : $product->description }}</textarea>
        </div>
        <div class="field-row">
            <label for="brand">Brand</label>
            <select id="brand" name="brand_id">
                <option value="" {{ !$create && $product->brand_id == null ? 'selected' : '' }}>[None]</option>
                @foreach($brands as $brand)
                    <option
                        value="{{ $brand->id }}" {{ !$create && $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="register-btn">
            Save
        </button>
    </form>

    @if ($errors->any())
        <div class="form-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</main>

@include('components.footer')

@include('components.mobile-nav')

</body>
</html>
