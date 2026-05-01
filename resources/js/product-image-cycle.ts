const picture = <HTMLPictureElement>document.getElementById('main-image');
const image = <HTMLImageElement>picture.getElementsByTagName('img')[0];
const source = <HTMLSourceElement>picture.getElementsByTagName('source')[0];

const prevBtn = <HTMLButtonElement>document.getElementById('prev-image');
const nextBtn = <HTMLButtonElement>document.getElementById('next-image');
const statusLabel = <HTMLParagraphElement>document.getElementById('image-status');

if (picture && image && source && prevBtn && nextBtn && statusLabel) {
    const imageUrls: string[] = JSON.parse(picture.dataset['imageUrls']);
    const avifUrls: string[] = JSON.parse(picture.dataset['avifUrls']);
    const imageCount = imageUrls.length;

    let currentIdx = 0;

    function swapImage() {
        source.srcset = avifUrls[currentIdx];
        image.src = imageUrls[currentIdx];
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
