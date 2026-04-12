const amountField = document.getElementById("amount-field");

if (amountField instanceof HTMLInputElement) {
    document.getElementById("amount-plus")?.addEventListener('click', () => {
        amountField.value = (Number.parseInt(amountField.value) + 1).toString();
    });
    document.getElementById("amount-minus")?.addEventListener('click', () => {
        amountField.value = (Number.parseInt(amountField.value) - 1).toString();
    });
}
