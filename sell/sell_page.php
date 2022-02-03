<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Sell</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="stylesheet.css">
  <style>
    html, body {
    background-color:#00001a;
    display: flex;
    justify-content: center;
    height: 100%;
    }
    body, div, h1, form, input, p, select {
    padding: 0;
    margin: 0;
    outline: none;
    font-family: Roboto, sans-serif;
    font-size: 16px;
    color: #eee;
    }
    h1 {
    padding: 10px 0;
    font-size: 32px;
    font-weight: 300;
    text-align: center;
    }
    p {
    font-size: 12px;
    }
    .main-block {
    height: auto;
    border-radius: 20px;
    box-sizing: border-box;
    max-width: 340px;
    min-height: 460px;
    padding: 10px 0;
    margin: auto;
    background: #15172b;
    }
    form {
    margin: 0 30px;
    }
    .placeholder{
    color: #65657b;
    font-family: sans-serif;
    left: 20px;
    top: 20px;
    }
    input[type=text], input[type=password], input[type=number], select , input[type=date]{
    margin: 13px 0 0 -5px;
    padding-left: 10px;
    background-color: #303245;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    font-size: 18px;
    height: 40px;
    padding: 4px 20px 0;
    width: 100%;
    -moz-appearance: textfield;
    }
  /*  input:invalid {
    border: 2px dashed red;
    }
  */  #button {
    background-color: #08d;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center;
    width: 100%;
    }
    #button:hover {
    background: #008cff;
    }
    #button_reset {
    background-color: #d03f44;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center;
    width: 100%;
    }
    #button_reset:hover {
    background:#e91640;
    }

  </style>
</head>
  </head>
  <body>
    <div class="main-block">
          <h1>Sell Sneaker</h1>

        <form action="insert_sell.php" name="sell_info" method="POST" onsubmit="return validate();">

            <label id="icon" for="sneakerID"></label>
            <input type="number" name="sneakerID" id="sneakerID" placeholder="ID" step="1" required/>

            <label id="icon" for="sell_date"></label>
            <input type="text" name="sell_date" id="sell_date" name="sell_date" placeholder="Sell date" value="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')"/>

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
            <input type="number" name="selling_price" id="selling_price" placeholder="Selling price" step="1" required/>

            <label id="icon" for="profit_account"></label>
            <select id="select" name="profit_account" required>
              <option value="SK">Savings-account</option>
              <option value="HK">Main-account</option>
            </select>

            <label id="icon" for="shipping_fee"></label>
            <input type="number" name="shipping_fee" id="shipping_fee" placeholder="Shipping fee" step="1" required/>

            <label id="icon" for="transaction_fee"></label>
            <input type="number" name="transaction_fee" id="transaction_fee" placeholder="Transaction fee" step="1" required/>

            <label id="icon" for="rounded_with_hk"></label>
            <input type="number" name="rounded_with_hk" id="rounded_with_hk" placeholder="Rounded with main-account" step="1" required/>

            <label id="icon" for="payout"></label>
            <input type="number" name="payout" id="payout" placeholder="Payout" step="1" required/>

            <label id="icon" for="profit"></label>
            <input type="number" name="profit" id="profit" placeholder="Profit" step="1" required/>

            <label id="icon" for="payout_on_sk"></label>
            <input type="number" name="payout_on_sk" id="payout_on_sk" placeholder="Payout on savings-account" step="1" required/>
            <div>
              <br>
              <button id ="button" type="submit" value="Submit">Submit</button>
            </div>
          </form>
          <form action="https://sneakertrackingberlin.de/">
        <input id ="button_reset"  type="submit" value="Discard" />
          </form>
        </div>
        <script>
        /*
        console.log((+document.sell_info.selling_price.value - (+document.sell_info.shipping_fee.value + +document.sell_info.transaction_fee.value) !== +document.sell_info.payout.value));
        console.log((+document.sell_info.rounded_with_hk.value + +document.sell_info.profit.value) !== +document.sell_info.payout_on_sk.value);
        debugger;
        */
        function validate(){
        if((+document.sell_info.selling_price.value - (+document.sell_info.shipping_fee.value + +document.sell_info.transaction_fee.value) !== +document.sell_info.payout.value) || (+document.sell_info.rounded_with_hk.value + +document.sell_info.profit.value) !== +document.sell_info.payout_on_sk.value) {
          alert("- Difference between selling price and fees must be equalto payout! \n\n- Diference between payout and 'rounded with main-account' must be equal to 'Payout on savings-account'");
          return false;
        }
        }
      </script>
</html>
