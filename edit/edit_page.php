<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\buy\buy_page.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Edit</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <script src="..\js\clearForm.js"></script>

</head>

<body>
    <div class="main-block">
        <?php
        $sneakerInfo =  $_SESSION['sql'];
        ?>
        <h1>Edit Sneaker info</h1>

        <form id="edit_form" action="update.php" method="POST">
            <label id="icon" for="brand"></label>
            <select id="select" name="brand" required>
                <option <?php if($sneakerInfo[brand] == 'Brand'){echo('selected="selected"');}?>value="" disabled
                    selected>Brand</option>
                <option <?php if($sneakerInfo[brand] == 'Adidas'){echo('selected="selected"');}?>value="Adidas">Adidas
                </option>
                <option
                    <?php if($sneakerInfo[brand] == 'Adidas YEEZY'){echo('selected="selected"');}?>value="Adidas YEEZY">
                    Adidas YEEZY</option>
                <option <?php if($sneakerInfo[brand] == 'Nike'){echo('selected="selected"');}?>value="Nike">Nike
                </option>
                <option
                    <?php if($sneakerInfo[brand] == 'Nike Air Jordan'){echo('selected="selected"');}?>value="Nike Air Jordan">
                    Nike Air Jordan
                </option>

                <option <?php if($sneakerInfo[brand] == 'Puma'){echo('selected="selected"');}?>value="Puma">Puma
                </option>
                <option
                    <?php if($sneakerInfo[brand] == 'New Balance'){echo('selected="selected"');}?>value="New Balance">
                    New Balance</option>
                <option <?php if($sneakerInfo[brand] == 'Puma'){echo('selected="selected"');}?>value="Puma">Puma
                </option>
                <option <?php if($sneakerInfo[brand] == 'Crocs'){echo('selected="selected"');}?>value="Crocs">Crocs
                </option>
                <option <?php if($sneakerInfo[brand] == 'Converse'){echo('selected="selected"');}?>value="Converse">
                    Converse
                </option>
                <option <?php if($sneakerInfo[brand] == 'Asics'){echo('selected="selected"');}?>value="Asics">
                Asics
                </option>
                <option <?php if($sneakerInfo[brand] == 'Reebok'){echo('selected="selected"');}?>value="Reebok">
                Reebok
                </option>
                <option <?php if($sneakerInfo[brand] == 'Onitsuka Tiger'){echo('selected="selected"');}?>value="Onitsuka Tiger">
                Onitsuka Tiger
                </option>
                <option <?php if($sneakerInfo[brand] == 'Hoka'){echo('selected="selected"');}?>value="Hoka">
                Hoka
                </option>
                <option <?php if($sneakerInfo[brand] == 'Salomon'){echo('selected="selected"');}?>value="Salomon">
                Salomon
                </option>
                <option <?php if($sneakerInfo[brand] == 'Autry'){echo('selected="selected"');}?>value="Autry">
                Autry
                </option>
                <option <?php if($sneakerInfo[brand] == 'Karhu'){echo('selected="selected"');}?>value="Karhu">
                Karhu
                </option>
                <option <?php if($sneakerInfo[brand] == 'Represent Clo'){echo('selected="selected"');}?>value="Represent Clo">
                Represent Clo
                </option>
                <option <?php if($sneakerInfo[brand] == 'Axel Arigato'){echo('selected="selected"');}?>value="Axel Arigato">
                Axel Arigato
                </option>
                <option <?php if($sneakerInfo[brand] == 'On'){echo('selected="selected"');}?>value="On">
                On
                </option>
                <option <?php if($sneakerInfo[brand] == 'Mizuno'){echo('selected="selected"');}?>value="Mizuno">
                Mizuno
                </option>
                <option <?php if($sneakerInfo[brand] == 'Diadora'){echo('selected="selected"');}?>value="Diadora">
                Diadora
                </option>
                <option <?php if($sneakerInfo[brand] == 'Brooks'){echo('selected="selected"');}?>value="Brooks">
                Brooks
                </option>
                <option <?php if($sneakerInfo[brand] == 'Saucony'){echo('selected="selected"');}?>value="Saucony">
                Saucony
                </option>
                <option <?php if($sneakerInfo[brand] == 'Others'){echo('selected="selected"');}?>value="Others">
                Others
                </option>
            </select>

            <label id="icon" for="sku"></label>
            <input type="text" name="sku" id="sku" value="<?php echo $sneakerInfo[sku] ?>" required />

            <label id="icon" for="modell"></label>
            <input type="text" name="modell" id="modell" value="<?php echo $sneakerInfo[modell] ?>" required />

            <label id="icon" for="colorway"></label>
            <input type="text" name="colorway" id="colorway" value="<?php echo $sneakerInfo[colorway] ?>" required />

            <label id="icon" for="condition"></label>
            <select id="select" name="condition">
                <option
                    <?php if($sneakerInfo[condition] == 'deadstock'){echo('selected="selected"');}?>value="deadstock">
                    Deadstock</option>
                <option <?php if($sneakerInfo[condition] == 'used'){echo('selected="selected"');}?>value="used">Used
                </option>
            </select>


            <label id="icon" for="age"></label>
            <select id="select" name="age">
                <option <?php if($sneakerInfo[age] == 'Adults'){echo('selected="selected"');}?> value="Adults">Adults
                </option>
                <option <?php if($sneakerInfo[age] == 'Kids'){echo('selected="selected"');}?>value="Kids">Kids</option>
                <option <?php if($sneakerInfo[age] == 'Infants'){echo('selected="selected"');}?>value="Infants">Infants
                </option>
            </select>

            <label id="icon" for="size"></label>
            <input type="number" name="size" id="size" value="<?php echo $sneakerInfo[size] ?>" step="0.5" required />


            <label id="icon" for="buy_shop"></label>
            <select id="select" name="buy_shop" required>
                <option <?php if($sneakerInfo[buy_shop] == 'Buy hop'){echo('selected="selected"');}?>value="" disabled
                    selected>Buy Shop</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Confirmed'){echo('selected="selected"');}?>value="Confirmed">
                    Confirmed</option>
                <option <?php if($sneakerInfo[buy_shop] == 'Vinted'){echo('selected="selected"');}?>value="Vinted">
                    Vinted</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Vinted-System'){echo('selected="selected"');}?>value="Vinted-System">
                    Vinted-System</option>

                <option <?php if($sneakerInfo[buy_shop] == 'Ebay'){echo('selected="selected"');}?>value="Ebay">Ebay
                </option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Kleinanzeigen'){echo('selected="selected"');}?>value="Kleinanzeigen">
                    Kleinanzeigen</option>
                <option <?php if($sneakerInfo[buy_shop] == 'SNS'){echo('selected="selected"');}?>value="SNS">SNS
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'SVD'){echo('selected="selected"');}?>value="SVD">SVD
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'Solebox'){echo('selected="selected"');}?>value="Solebox">
                    Solebox</option>
                <option <?php if($sneakerInfo[buy_shop] == 'Overkill'){echo('selected="selected"');}?>value="Overkill">
                    Overkill</option>
                <option <?php if($sneakerInfo[buy_shop] == 'Afew'){echo('selected="selected"');}?>value="Afew">Afew
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'Kickz'){echo('selected="selected"');}?>value="Kickz">Kickz
                </option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Luisaviaroma'){echo('selected="selected"');}?>value="Luisaviaroma">
                    Luisaviaroma</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'END Clothing'){echo('selected="selected"');}?>value="End Clothing">
                    END Clothing</option>
                <option <?php if($sneakerInfo[buy_shop] == 'BSTN'){echo('selected="selected"');}?>value="BSTN">BSTN
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'Footshop'){echo('selected="selected"');}?>value="Footshop">
                    Footshop</option>
                <option <?php if($sneakerInfo[buy_shop] == 'SOTO'){echo('selected="selected"');}?>value="SOTO">SOTO
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'Titolo'){echo('selected="selected"');}?>value="Titolo">
                    Titolo</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == '43einhalb'){echo('selected="selected"');}?>value="43einhalb">
                    43einhalb</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Asphaltgold'){echo('selected="selected"');}?>value="Asphaltgold">
                    Asphaltgold</option>
                <option <?php if($sneakerInfo[buy_shop] == 'size?'){echo('selected="selected"');}?>value="Size?">size?
                </option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'JD Sports'){echo('selected="selected"');}?>value="JD Sports">JD
                    Sports</option>
                <option <?php if($sneakerInfo[buy_shop] == 'Nike'){echo('selected="selected"');}?>value="Nike">Nike
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'SNKRS'){echo('selected="selected"');}?>value="SNKRS">SNKRS
                </option>
                <option <?php if($sneakerInfo[buy_shop] == 'StockX'){echo('selected="selected"');}?>value="StockX">
                    StockX</option>
                <option
                    <?php if($sneakerInfo[buy_shop] == 'Flea market'){echo('selected="selected"');}?>value="Flea market">
                    Flea market</option>

                <option <?php if($sneakerInfo[buy_shop] == 'Others'){echo('selected="selected"');}?>value="Others">
                    Others</option>
            </select>

            <label id="icon" for="buy_date"></label>
            <input type="text" name="buy_date" id="buy_date" name="buy_date"
                value="<?php echo $sneakerInfo[buy_date] ?>" value="<?php echo date('Y-m-d'); ?>" required
                onfocus="(this.type='date')" />

            <label id="icon" for="buying_price"></label>
            <input type="number" name="buying_price" id="buying_price" value="<?php echo $sneakerInfo[buying_price] ?>"
                step="0.01" required />

            <br><br>

            <input type="checkbox" name="purchase_invoice" id="purchase_invoice" value="1"
                <?php if ($sneakerInfo['purchase_invoice'] == 1) echo 'checked'; ?> />
            <label id="icon" for="purchase_invoice">Purchase Invoice is documented</label>

            <div><br>
                <button id="button" type="submit" onsubmit="clearForm()" value="Submit">Edit</button>
            </div>
        </form>
        <form>
            <input onclick="window.location.href='../index.html'" id="button_reset" type="button" value="Discard" />
        </form>
    </div>
</body>

</html>