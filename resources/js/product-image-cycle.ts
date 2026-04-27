const imageRoots = document.querySelectorAll<HTMLElement>('[data-product-image-cycle]');

for (const root of imageRoots) {
    const image = root.querySelector<HTMLImageElement>('.main-image[data-alt-src]');
    const button = root.querySelector<HTMLButtonElement>('.cycle-image-btn');

    if (!image || !button) {
        continue;
    }

    const swapImage = () => {
        const altSrc = image.dataset.altSrc;
        if (!altSrc) {
            return;
        }

        image.dataset.altSrc = image.src;
        image.src = altSrc;
    };

    button.addEventListener('click', (event) => {
        event.preventDefault();
        swapImage();
    });

    button.addEventListener('keydown', (event) => {
        if (event.key === 'Enter'||event.key === ' ') {
            event.preventDefault();
            swapImage();
        }
    });
}