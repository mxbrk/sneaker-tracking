function validateSellForm() {
    if (+document.sell_info.selling_price.value - (+document.sell_info.shipping_fee.value + +document.sell_info
            .transaction_fee.value) !== +document.sell_info.payout.value) {
        alert(
            "Selling price - (shipping fee + transaction fee) = payout "
        );
        return false;
    }
}
