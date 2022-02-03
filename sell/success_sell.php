<?php
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Success-Sell</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
  </head>
  <style media="screen">
    body {
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
      text-align: center;
      background: #00001a;
    }
    h1 {
    padding: 10px 0;
    font-size: 32px;
    font-family: Roboto, sans-serif;
    font-weight: 300;
    text-align: center;
    color: #FFFFFF;
    }
    .category-info {
    text-align: center;
    overflow: auto;
    margin-bottom: 20px;
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
      margin-top: 30px;
      margin-bottom: 10px;
      margin-left: 10px;
      margin-right:  10px;
      text-align: center;
      width: 280px;
    }
    button:hover {
    background: #008cff;
    }
  </style>
  <body>
<div class="category-info">
<img src="greencheck.png"/><br>
  <h1>Your sneaker entry was succesfully updated with all selling information</h1>
    <div>
      <form action="https://sell.sneakertrackingberlin.de/">
    <input id ="button" type="submit" value="Sell another sneaker" />
      </form>
      <form action="https://sneakertrackingberlin.de/">
    <input id ="button"  type="submit" value="Go to homepage" />
      </form>
    </div>
  </body>
</html>
?>
