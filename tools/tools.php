<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel='stylesheet' media='screen' href='..\css\stores.css'>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Tools</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <script src="..\js\calcFees.js"></script>
  </head>
  <body>
    <div class="main-block">
    <h1>Tools</h1>
    <form id="calcFeesForm">
            <input type="number" id="calcFeesInput" name="calcFeesInput" placeholder="Net-Price" step="0.01" required>
            <button id="button" type="button" onclick="calcFees()">Calculate</button>
        </form>
    <form action="public_html/index.html/">
      <input onclick="window.location.href='../index.html'" id ="button"  type="button" value="Home" />
    </form>
    </div>
  </body>
</html>