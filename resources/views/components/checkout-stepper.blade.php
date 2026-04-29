<section class="checkout-steps" aria-label="Checkout steps">
    <ol class="checkout-stepper">
        <li class="step-item {{ $step == 'details' ? 'is-active' : '' }}"
            {{ $step == 'details' ? 'aria-current="step"' : '' }}>
            <span class="step-index" aria-hidden="true">1</span>
            <span class="step-label">Details</span>
        </li>
        <li class="step-item {{ $step == 'review' ? 'is-active' : '' }}"
            {{ $step == 'review' ? 'aria-current="step"' : '' }}>
            <span class="step-index" aria-hidden="true">2</span>
            <span class="step-label">Review</span>
        </li>
        <li class="step-item {{ $step == 'payment' ? 'is-active' : '' }}"
            {{ $step == 'payment' ? 'aria-current="step"' : '' }}>
            <span class="step-index" aria-hidden="true">3</span>
            <span class="step-label">Payment</span>
        </li>
    </ol>
</section>
