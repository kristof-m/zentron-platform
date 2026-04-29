const mainImage = <HTMLImageElement>document.getElementById('main-image');
const prevBtn = <HTMLButtonElement>document.getElementById('prev-image');
const nextBtn = <HTMLButtonElement>document.getElementById('next-image');
const statusLabel = <HTMLParagraphElement>document.getElementById('image-status');

if (mainImage && prevBtn && nextBtn && statusLabel) {
    const imageUrls: string[] = JSON.parse(mainImage.dataset['imageUrls']);
    const imageCount = imageUrls.length;

    let currentIdx = 0;

    function swapImage() {
        mainImage.src = imageUrls[currentIdx];
    }

    function renderStatus() {
        statusLabel.innerText = `Image ${currentIdx + 1} of ${imageCount}`
    }

    prevBtn.addEventListener('click', (event) => {
        event.preventDefault();

        if (currentIdx == 0) {
            currentIdx = imageCount - 1;
        } else {
            currentIdx--;
        }
        swapImage();
        renderStatus();
    });

    nextBtn.addEventListener('click', (event) => {
        event.preventDefault();

        if (currentIdx == imageCount - 1) {
            currentIdx = 0;
        } else {
            currentIdx++;
        }
        swapImage();
        renderStatus();
    });
}
