<header>
    <a class="home-link" href="/">
        <h1>zentron</h1>
    </a>

    <nav class="desktop-nav no-mobile" aria-label="Main navigation">
        <a class="black-link" href="/admin/products">Edit Products</a>
    </nav>

    <div class="spacer" aria-hidden="true"></div>

    <div class="header-tools">
        @include('components.search-bar')

        <a class="icon-button no-mobile" href="/cart">
            <img
                src="{{ Vite::asset('resources/icons/ShoppingCart.svg') }}"
                alt="Cart"
                class="search-icon"
            />
        </a>

        @auth
            <a href="/admin/home" class="black-link no-mobile">Admin</a>
        @else
            <a href="/admin/login" class="black-link no-mobile">Sign in</a>
        @endauth
    </div>
</header>
