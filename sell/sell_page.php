<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\sell\sell_page.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Sell</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script src="..\js\validateSellForm.js"></script>
    <script src="..\js\calcProfit.js"></script>


</head>

<body>
    <div class="main-block">
        <?php
        $sneakerInfo =  $_SESSION['sql'];
        ?>
        <h1>Sell Sneaker</h1>

        <form action="insert_sell.php" name="sell_info" method="POST" onsubmit="return validateSellForm();">

            <label style="display: none;" id="icon" for="sneakerID"></label>
            <input style="display: none;" type="number" name="sneakerID" id="sneakerID"
                value="<?php echo $sneakerInfo[sneakerID] ?>" step="1" required />

            <label style="display: none;" id="icon" for="buying_price"></label>
            <input style="display: none;" type="number" name="buying_price" id="buying_price"
                value="<?php echo $sneakerInfo[buying_price] ?>" step="1" required />


            <label id="icon" for="sell_date"></label>
            <input type="text" name="sell_date" id="sell_date" name="sell_date" placeholder="Sell date"
                value="<?php echo $sneakerInfo[sell_date] == true ? $sneakerInfo[sell_date] : date('Y-m-d'); ?>" required onfocus="(this.type='date')" />

            <label id="icon" for="sell_shop"></label>
            <select id="select" name="sell_shop" required autofocus>
                <option <?php if($sneakerInfo[sell_shop] == 'Sell shop'){echo('selected="selected"');}?>value=""
                    disabled selected>Sell Shop</option>
                <option <?php if($sneakerInfo[sell_shop] == 'StockX'){echo('selected="selected"');}?>value="StockX">
                    StockX</option>
                <option <?php if($sneakerInfo[sell_shop] == 'alias'){echo('selected="selected"');}?>value="alias">alias
                </option>
                <option <?php if($sneakerInfo[sell_shop] == 'Vinted'){echo('selected="selected"');}?>value="Vinted">
                    Vinted</option>
                <option
                    <?php if($sneakerInfo[sell_shop] == 'Vinted-System'){echo('selected="selected"');}?>value="Vinted-System">
                    Vinted-System</option>

                <option
                    <?php if($sneakerInfo[sell_shop] == 'Kleinanzeigen'){echo('selected="selected"');}?>value="Kleinanzeigen">
                    Kleinanzeigen</option>
                <option <?php if($sneakerInfo[sell_shop] == 'Ebay'){echo('selected="selected"');}?>value="Ebay">Ebay
                </option>
                <option <?php if($sneakerInfo[sell_shop] == 'Others'){echo('selected="selected"');}?>value="Others">
                    Others</option>
            </select>

            <label id="icon" for="selling_price"></label>
            <input type="number" name="selling_price" id="selling_price" placeholder="Selling price" step="0.01"
                value="<?php echo $sneakerInfo[selling_price] ?>" required />

            <label id="icon" for="payout"></label>
            <input oninput="calcProfit()" type="number" name="payout" id="payout" placeholder="Payout"
                value="<?php echo $sneakerInfo[payout] ?>" step="0.01" required />


            <label id="icon" for="shipping_fee"></label>
            <input type="number" name="shipping_fee" id="shipping_fee" placeholder="Shipping fee" step="0.01"
                value="<?php echo $sneakerInfo[shipping_fee] ?>" required />

            <label id="icon" for="transaction_fee"></label>
            <input type="number" name="transaction_fee" id="transaction_fee"
                value="<?php echo $sneakerInfo[transaction_fee] ?>" placeholder="Transaction fee" step="0.01"
                required />

            <label id="icon" for="profit"></label>
            <input type="number" name="profit" id="profit" placeholder="Profit" step="0.01"
                value="<?php echo $sneakerInfo[profit] ?>" required />

            <label id=" icon" for="invoiceNumber"></label>
            <input type="text" name="invoiceNumber" id="invoiceNumber" placeholder="Invoice #"
                value="<?php echo $sneakerInfo[invoiceNumber] ?>" />

            <div>
                <br>
                <button id="button" type="submit" value="Submit">Submit</button>
            </div>
        </form>
        <form>
            <input onclick="window.location.href='../index.html'" id="button_reset" type="button" value="Discard" />
        </form>
    </div>

</html>