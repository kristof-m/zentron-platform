<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    @vite('resources/css/index.css')
    @vite('resources/css/style.css')
    <link rel="icon" type="image/svg+xml" href="/vite.svg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="zentron store home page"/>
    <title>zentron</title>
</head>

<body>
@include('components.header')

<article class="deals-card" aria-label="Featured promotions">
    <a class="deal-tile" href="#">
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

    <a class="deal-tile no-mobile" href="#">
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
