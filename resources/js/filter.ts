const formElement: HTMLFormElement | null = document.querySelector(".catalog-controls");

if (formElement) {
    formElement.addEventListener('submit', e => {
        e.preventDefault();
        // @ts-ignore TS2345: type definition is wrong
        const params = new URLSearchParams(new FormData(e.currentTarget));
        location.replace(`${window.location.pathname}?${params.toString()}`);
    });

    for (const node of document.querySelectorAll(".catalog-controls input, .catalog-controls select")) {
        if (node instanceof HTMLInputElement || node instanceof HTMLSelectElement) {
            node.addEventListener('change', () => {
                formElement.requestSubmit();
            })
        }
    }

    // hide apply button with js turned on
    let applyBtn = document.getElementById('apply-filter');
    if (applyBtn) {
        applyBtn.hidden = true;
    }
}
