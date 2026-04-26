<!doctype html>
<html lang="en">
<head>
    <x-meta-tags :title="$create ? 'new brand' : 'edit brand'"/>
    @vite('resources/css/style.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/form.css')
</head>

<body class="admin-page">

@include('admin.header')

<h1 class="page-title">{{ $create ? 'New brand' : 'Editing '.$brand->name }}</h1>

<main>
    <form class="form" action="{{ $create ? route('brand.create') : route('brand.update', [$brand]) }}"
          method="post">
        @csrf
        <div class="field-row">
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ $create ? '' : $brand->name }}" placeholder="AMD"/>
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
