function validateSellForm() {
    // Runde die Zahlen auf 2 Dezimalstellen mit toFixed(2)
    const sellingPrice = +parseFloat(document.sell_info.selling_price.value).toFixed(2);
    const shippingFee = +parseFloat(document.sell_info.shipping_fee.value).toFixed(2);
    const transactionFee = +parseFloat(document.sell_info.transaction_fee.value).toFixed(2);
    const payoutPrice = +parseFloat(document.sell_info.payout.value).toFixed(2);

    console.log("Debugging: selling Price =", sellingPrice);
    console.log("Debugging: shipping Fee =", shippingFee);
    console.log("Debugging: transaction Fee =", sellingPrice);
    console.log("Debugging: payout Price =", payoutPrice);

    if (+parseFloat(sellingPrice - (shippingFee + transactionFee)).toFixed(2) !== payoutPrice) {
        //parseFloat formatiert Wert zurück zu numerischen Wert weil toFixed den Wert zu einem String formatiert, 
        //dieser komplizierte Ansatz ist nötig weil in der if-Bedingung anstatt 2 eine 1,99999 (Bsp.) berechnet wird.
        // (sellingPrice - (shippingFee + transactionFee) !== payoutPrice) wäre in diesem Fall nicht (2 !== 2) sondern (1,99999 !== 2)
        alert("Selling price - (shipping fee + transaction fee) should be equal to payout.");
        return false;
    }
};