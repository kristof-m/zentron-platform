<article>
    <a class="card" href="/product/{{ $product->id }}">
        <img
            class="product-image"
            alt="{{ $product->name }}"
            src=""
            width="512"
            height="512"
        />
        <h2 class="product-name">{{ $product->name }}</h2>
        <div class="card-tags">
            <span class="card-tag"> Apple </span>
            <span class="card-tag"> Smartphones </span>
        </div>
        <div class="spacer" aria-hidden="true"></div>
        <p class="product-price">{{ $product->price }} €</p>
    </a>
</article>
