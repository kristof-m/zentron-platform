const imageRoots = document.querySelectorAll<HTMLElement>('[data-product-image-cycle]');

for (const root of imageRoots) {
    const image = root.querySelector<HTMLImageElement>('.main-image[data-alt-src]');
    const button = root.querySelector<HTMLButtonElement>('.cycle-image-btn');
    const status = root.querySelector<HTMLElement>('.cycle-image-status');

    if (!image || !button) {
        continue;
    }

    const normalizeUrl = (url: string) => new URL(url, window.location.href).href;

    const currentSrc = normalizeUrl(image.src);
    const altSrc = image.dataset.altSrc;

    if (!altSrc || normalizeUrl(altSrc) === currentSrc) {
        button.hidden = true;
        if (status) {
            status.hidden = true;
        }
        continue;
    }

    const image1Url = normalizeUrl(image.src);
    let isShowingImage1 = true;

    const swapImage = () => {
        const altSrc = image.dataset.altSrc;
        if (!altSrc) {
            return;
        }

        const nextSrc = altSrc;
        image.dataset.altSrc = image.src;
        image.src = nextSrc;


        isShowingImage1 = !isShowingImage1;

        if (status) {
            status.textContent = isShowingImage1 ? 'Image 1 of 2' : 'Image 2 of 2';
        }
    };

    button.addEventListener('click', (event) => {
        event.preventDefault();
        swapImage();
    });

    button.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            swapImage();
        }
    });
}