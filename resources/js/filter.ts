const formElement: HTMLFormElement | null = document.querySelector(".catalog-controls");

if (formElement) {
    for (const node of document.querySelectorAll(".catalog-controls input, .catalog-controls select")) {
        if (node instanceof HTMLInputElement || node instanceof HTMLSelectElement) {
            node.addEventListener('change', () => {
                formElement.submit();
            })
        }
    }
}
