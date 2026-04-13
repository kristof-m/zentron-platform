const amountField = document.getElementById("amount-field");
const minusBtn = document.getElementById("amount-minus");
const plusBtn = document.getElementById("amount-plus");

if (amountField instanceof HTMLInputElement && minusBtn instanceof HTMLButtonElement && plusBtn instanceof HTMLButtonElement){
  const syncButtons = () => {
    const amount = Number.parseInt(amountField.value || "1");
    if (amount < 1) amountField.value = "1";
    minusBtn.disabled = (Number.parseInt(amountField.value)) <= 1;
  };

  plusBtn.addEventListener("click", () => {
    amountField.value = (Number.parseInt(amountField.value) + 1).toString();
    syncButtons();
  });

  minusBtn.addEventListener("click", () => {
    if (!minusBtn.disabled) {
      amountField.value = (Number.parseInt(amountField.value) - 1).toString();
      syncButtons();
    }
  });

  amountField.addEventListener("input", syncButtons);
  syncButtons();
}