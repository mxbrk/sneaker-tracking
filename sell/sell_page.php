<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\sell\sell_page.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Sell</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>

<body>
    <div class="main-block">
        <h1>Sell Sneaker</h1>

        <form action="insert_sell.php" name="sell_info" method="POST" onsubmit="return validate();">

            <label id="icon" for="sneakerID"></label>
            <input type="number" name="sneakerID" id="sneakerID" placeholder="ID" step="1" required />

            <label id="icon" for="sell_date"></label>
            <input type="text" name="sell_date" id="sell_date" name="sell_date" placeholder="Sell date"
                value="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')" />

            <label id="icon" for="sell_shop"></label>
            <select id="select" name="sell_shop" required>
                <option value="" disabled selected>Sell Shop</option>
                <option value="Stockx">StockX</option>
                <option value="Goat">GOAT</option>
                <option value="Vinted">Vinted</option>
                <option value="Ebay Kleinanzeigen">Ebay Kleinanzeigen</option>
                <option value="Ebay">Ebay</option>
                <option value="Others">Others</option>
            </select>

            <label id="icon" for="selling_price"></label>
            <input type="number" name="selling_price" id="selling_price" placeholder="Selling price" step="0.01"
                required />

            <label id="icon" for="payout"></label>
            <input type="number" name="payout" id="payout" placeholder="Payout" step="0.01" required />

            <label id="icon" for="shipping_fee"></label>
            <input type="number" name="shipping_fee" id="shipping_fee" placeholder="Shipping fee" step="0.01"
                required />

            <label id="icon" for="transaction_fee"></label>
            <input type="number" name="transaction_fee" id="transaction_fee" placeholder="Transaction fee" step="0.01"
                required />

            <label id="icon" for="profit"></label>
            <input type="number" name="profit" id="profit" placeholder="Profit" step="0.01" required />

            <div>
                <br>
                <button id="button" type="submit" value="Submit">Submit</button>
            </div>
        </form>
        <form>
            <input onclick="window.location.href='../index.html'" id="button_reset" type="button" value="Discard" />
        </form>
    </div>
    <script>
    /*
        console.log((+document.sell_info.selling_price.value - (+document.sell_info.shipping_fee.value + +document.sell_info.transaction_fee.value) !== +document.sell_info.payout.value));
        console.log((+document.sell_info.rounded_with_hk.value + +document.sell_info.profit.value) !== +document.sell_info.payout_on_sk.value);
        debugger;
        
    function validate() {
        if ((+document.sell_info.selling_price.value - (+document.sell_info.shipping_fee.value + +document.sell_info
                .transaction_fee.value) !== +document.sell_info.payout.value) || (+document.sell_info.rounded_with_hk
                .value + +document.sell_info.profit.value) !== +document.sell_info.payout_on_sk.value) {
            alert(
                "- Difference between selling price and fees must be equalto payout! \n\n- Diference between payout and 'rounded with main-account' must be equal to 'Payout on savings-account'"
            );
            return false;
        }
    }
    */
    </script>

</html>