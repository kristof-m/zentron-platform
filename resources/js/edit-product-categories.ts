const tags = <HTMLCollectionOf<HTMLButtonElement>>document.getElementsByClassName("category-add");

for (const tag of tags) {
    const symbolSpan = <HTMLSpanElement>tag.getElementsByClassName("symbol")[0];
    const input = <HTMLInputElement>tag.getElementsByTagName("input")[0];

    tag.addEventListener("click", (e) => {
        e.preventDefault();

        if (input.value == "1") {
            input.value = "0";
            symbolSpan.textContent = "❌";
        } else {
            input.value = "1";
            symbolSpan.textContent = "✅";
        }
    })
}
