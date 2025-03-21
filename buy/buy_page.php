<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\buy\buy_page.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Buy</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script src="..\js\skuUppercase.js"></script>
</head>

<body>
    <div class="main-block">
        <h1>Buy Sneaker</h1>
        <form action="insert_purchase.php" method="POST">
            <label id="icon" for="brand"></label>
            <select id="select" name="brand" required autofocus>
                <option value="" disabled selected>Brand</option>
                <option value="Adidas">Adidas</option>
                <option value="Adidas YEEZY">Adidas YEEZY</option>
                <option value="Nike">Nike</option>
                <option value="Nike Air Jordan">Nike Air Jordan</option>
                <option value="New Balance">New Balance</option>
                <option value="Asics">Asics</option>
                <option value="Puma">Puma</option>
                <option value="Vans">Vans</option>
                <option value="Crocs">Crocs</option>
                <option value="Converse">Converse</option>
                <option value="Reebok">Reebok</option>
                <option value="Onitsuka Tiger">Onitsuka Tiger</option>
                <option value="Hoka">Hoka</option>
                <option value="Salomon">Salomon</option>
                <option value="Autry">Autry</option>
                <option value="Karhu">Karhu</option>
                <option value="Represent Clo">Represent Clo</option>
                <option value="Axel Arigato">Axel Arigato</option>
                <option value="On">On</option>
                <option value="Mizuno">Mizuno</option>
                <option value="Diadora">Diadora</option>
                <option value="Brooks">Brooks</option>
                <option value="Saucony">Saucony</option>
                <option value="Others">Others</option>
            </select>

            <label id="icon" for="sku"></label>
            <input type="text" name="sku" onkeyup="skuUppercase()" id="sku" placeholder="SKU" required />

            <label id="icon" for="modell"></label>
            <input type="text" name="modell" id="modell" placeholder="Model" required />

            <label id="icon" for="colorway"></label>
            <input type="text" name="colorway" id="colorway" placeholder="Colorway" required />

            <label id="icon" for="condition"></label>
            <select id="select" name="condition" required>
                <option value="deadstock">Deadstock</option>
                <option value="used">Used</option>
            </select>

            <label id="icon" for="age"></label>
            <select id="select" name="age">
                <option value="Adults">Adults</option>
                <option value="Kids">Kids</option>
                <option value="Infants">Infants</option>
            </select>

            <label id="icon" for="size"></label>
            <input type="number" name="size" id="size" placeholder="Size" step="0.5" required />


            <label id="icon" for="buy_shop"></label>
            <select id="select" name="buy_shop" required>
                <option value="" disabled selected>Buy Shop</option>
                <option value="Vinted">Vinted</option>
                <option value="Vinted-System">Vinted-System</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Ebay">Ebay</option>
                <option value="Kleinanzeigen">Kleinanzeigen</option>
                <option value="SNS">SNS</option>
                <option value="SVD">SVD</option>
                <option value="Solebox">Solebox</option>
                <option value="Overkill">Overkill</option>
                <option value="Afew">Afew</option>
                <option value="Kickz">Kickz</option>
                <option value="Luisaviaroma">Luisaviaroma</option>
                <option value="End Clothing">END Clothing</option>
                <option value="BSTN">BSTN</option>
                <option value="Footshop">Footshop</option>
                <option value="SOTO">SOTO</option>
                <option value="Titolo">Titolo</option>
                <option value="43einhalb">43einhalb</option>
                <option value="Asphaltgold">Asphaltgold</option>
                <option value="Size?">size?</option>
                <option value="JD Sports">JD Sports</option>
                <option value="Nike">Nike</option>
                <option value="SNKRS">SNKRS</option>
                <option value="StockX">StockX</option>
                <option value="Flea market">Flea market</option>
                <option value="Others">Others</option>
            </select>

            <label id="icon" for="date"></label>
            <input type="text" name="date" id="date" name="date" placeholder="Buy date"
                value="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')" />

            <label id="icon" for="buying_price"></label>
            <input type="number" name="buying_price" id="buying_price" placeholder="Price" step="0.01" required />

            <br><br>

            <input type="checkbox" name="purchase_invoice" id="purchase_invoice" value="1" />
            <label id="icon" for="purchase_invoice">Purchase Invoice is documented</label>

            <div><br>
                <button id="button" type="submit" value="Submit">Submit</button>
            </div>
        </form>
        <form>
            <input onclick="window.location.href='../index.html'" id="button_reset" type="button" value="Discard" />
        </form>
    </div>
</body>

</html>