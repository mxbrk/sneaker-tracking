<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Buy</title>
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
    #button {
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
          <h1>Buy Sneaker</h1>
          <form action="insert_purchase.php" method="POST">
            <label id="icon" for="brand"></label>
            <select id="select" name="brand" required>
              <option value="" disabled selected>Brand</option>
              <option value="Adidas">Adidas</option>
              <option value="Adidas YEEZY">Adidas YEEZY</option>
              <option value="Nike">Nike</option>
              <option value="New Balance">New Balance</option>
              <option value="Puma">Puma</option>
            </select>

            <label id="icon" for="modell"></label>
            <input type="text" name="modell" id="modell" placeholder="Model" required/>

            <label id="icon" for="colorway"></label>
            <input type="text" name="colorway" id="colorway" placeholder="Colorway" required/>


            <label id="icon" for="age"></label>
            <select id="select" name="age">
              <option value="Adults">Adults</option>
              <option value="Kids">Kids</option>
              <option value="Infants">Infants</option>
            </select>

            <label id="icon" for="size"></label>
            <input type="number" name="size" id="size" placeholder="Size" step="0.5" required/>


            <label id="icon" for="buy_shop"></label>
            <select id="select" name="buy_shop" required>
              <option value="" disabled selected>Buy Shop</option>
              <option value="Confirmed">Confirmed</option>
              <option value="Vinted">Vinted</option>
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
              <option value="Others">Others</option>

            </select>

            <label id="icon" for="buy_account"></label>
            <select id="select" name="buy_account" required>
              <option value="SK">Savings-account</option>
              <option value="HK">Main-account</option>
            </select>


            <label id="icon" for="date"></label>
            <input type="text" name="date" id="date" name="date" placeholder="Buy date" value="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')"/>

            <label id="icon" for="buying_price"></label>
            <input type="number" name="buying_price" id="buying_price" placeholder="Price" step="1" required/>
            <div><br>
              <button id ="button" type="submit" value="Submit">Submit</button>
            </div>
          </form>
          <form action="https://sneakertrackingberlin.de/">
        <input id ="button_reset"  type="submit" value="Discard" />
          </form>
        </div>
      </body>
</html>
