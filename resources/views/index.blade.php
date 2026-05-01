<!doctype html>
<html lang="en">
<head>
    <x-meta-tags title="home"/>
    @vite('resources/css/index.css')
    @vite('resources/css/style.css')
</head>

<body>
@include('components.header')

<article class="deals-card" aria-label="Featured promotions">
    <a class="deal-tile" href="/product/{{ $random_product_id_deals }}">
        <img
            alt="A set of colorful lava lamps on a shelf"
            class="deal-image"
            src="{{ Vite::asset('resources/images/lavaLamps.jpg') }}"
        />
        <div class="deal-copy">
            <p class="deal-kicker">Today's Deals</p>
            <h2>Retro Lights Sale</h2>
            <p>Save up to 35% on ambient desk and room lighting.</p>
        </div>
    </a>

    <a class="deal-tile no-mobile" href="/product/{{ $random_product_id_discounts }}">
        <img
            alt="A custom gaming desktop PC with RGB lights"
            class="deal-image"
            src="{{ Vite::asset('resources/images/gamingPCai.jpg') }}"
        />
        <div class="deal-copy">
            <p class="deal-kicker">Deep Discounts</p>
            <h2>Gaming PC Builds</h2>
            <p>Weekend drop on performance rigs and upgrade bundles.</p>
        </div>
    </a>
</article>

<main class="products home-products">
    @foreach($products as $product)
        <x-product-card :product="$product"/>
    @endforeach
</main>

@include('components.footer')

@include('components.mobile-nav')
</body>
</html>
