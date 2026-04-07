<header>
    <a class="home-link" href="/">
        <h1>zentron</h1>
    </a>

    <nav class="desktop-nav no-mobile" aria-label="Main navigation">
        <a class="black-link" href="/categories">Categories</a>
        <a class="black-link" href="/brands">Brands</a>
        <a class="black-link" href="/products">All Products</a>
    </nav>

    <div class="spacer" aria-hidden="true"></div>

    <div class="header-tools">
        <label class="search-box" for="search">
            <input id="search" type="search" placeholder="Search"/>
            <img
                src="{{ Vite::asset('resources/icons/Search.svg') }}"
                alt="Search"
                class="icon search-icon"
            />
        </label>

        <a class="icon-button no-mobile" href="/cart">
            <img
                src="{{ Vite::asset('resources/icons/ShoppingCart.svg') }}"
                alt="Cart"
                class="search-icon"
            />
        </a>

        @auth
            <a href="/account" class="black-link no-mobile">Account</a>
        @else
            <a href="/login" class="black-link no-mobile">Sign in</a>
        @endauth
    </div>
</header>
