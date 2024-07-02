function skuUppercase() {
  const inputField = document.getElementById("sku");
  inputField.addEventListener("keyup", function (event) {
    event.preventDefault();
    inputField.value = inputField.value.toUpperCase();
  });
}