@props(['product', 'imageUrls', 'avifUrls'])

<div class="main-image-wrap" data-product-image-cycle>
    <picture id="main-image"
             data-image-urls="{{ $imageUrls->toJson() }}"
             data-avif-urls="{{ $avifUrls->toJson() }}"
             class="main-picture">
        <source srcset="{{ $avifUrls[0] }}" type="image/avif"/>
        <img
            class="main-image"
            alt="{{ $product->name }}"
            src="{{ $imageUrls[0] }}"
        />
    </picture>
    <div class="image-controls">
        <button id="prev-image" class="icon-button image-arrow">
            <img alt="Previous image" src="{{ Vite::asset('resources/icons/arrow_left.svg') }}"/>
        </button>
        <p id="image-status" class="image-status" aria-live="polite">Image 1
            of {{ $imageUrls->count() }}</p>
        <button id="next-image" class="icon-button image-arrow">
            <img alt="Next image" src="{{ Vite::asset('resources/icons/arrow_right.svg') }}"/>
        </button>
    </div>
</div>
