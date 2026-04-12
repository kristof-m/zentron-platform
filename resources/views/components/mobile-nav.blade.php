<nav class="mobile-nav mobile-only">
    <a class="black-link" href="/cart">Cart</a>
    <a class="black-link" href="/categories">Categories</a>
    <a class="black-link" href="/products">Products</a>
    <a class="black-link" href="/brands">Brands</a>
    @auth
        <a href="/account" class="black-link">Account</a>
    @else
        <a href="/login" class="black-link">Sign in</a>
    @endauth
</nav>
