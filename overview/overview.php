<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Overview</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
  </head>
  <style media="screen">
  body{
  /*display: flex;
  justify-content: center;
  align-items: center;
  */text-align: center;
  background: #00001a;
  }
  table{ /*defining properties for div surrounding the talbe*/
  overflow: scroll;
  height: auto;
  border-radius: 20px;
  padding: 20px;
  margin: 30px;
  background: #15172b;
  border-collapse: collapse
  }
  td{ /*setting properties for table data/ cells*/
  color: #FFFFFF;
  font-family: Roboto, sans-serif;
  padding: 7px;
  text-align: center;
  }
  th{ /*setting properties for table head*/
  background: #08d;
  color: #FFFFFF;
  font-family: Roboto, sans-serif;
  padding: 11px;
  text-align: left;
  position:sticky;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
  top: 0;
  }
  tr td { /*dividing rows with thin grey line*/
  border-bottom: 1px solid #a6a6a6
  }
  tr:hover{ /*colorchange for mouseover*/
  background-color: #404040;
  }
  h1{ /*setting properties for page caption*/
  padding: 10px 0;
  font-size: 32px;
  font-weight: 300;
  text-align: center;
  font-family: Roboto, sans-serif;
  color: #FFFFFF;
  }
  table tr th:nth-child(2){ /*making the first column wider, that Sneaker name fits in one line*/
  width: 300px !important;
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
  #button:hover {
  background: #008cff;
  }

  </style>
  <body>
    <div class="table">
    <?php
    include '../db_config.php';
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT sneakerID,CONCAT(brand,' ', modell,' ', colorway)
    as sneaker,
    age,
    size,
    buy_shop,
    sell_shop ,
    buying_price,
    selling_price,
    buy_account,
    profit_account,
    shipping_fee + transaction_fee as fees,
    rounded_with_hk,payout,profit,payout_on_sk FROM sneaker ORDER BY sold ASC, sneakerID ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo
      "<table>
      <tr>
      <th>ID</th>
      <th>Sneaker</th>
      <th>Age</th>
      <th>Size</th>
      <th>Buy shop</th>
      <th>Sell shop</th>
      <th>Buy price</th>
      <th>Sell price</th>
      <th>Buy account</th>
      <th>Profit account</th>
      <th>Fees</th>
      <th>Rounded HK</th>
      <th>Payout</th>
      <th>Profit</th>
      <th>Payout SK</th>
      </tr>";

 // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
     <td>" . $row['sneakerID'] . "</td>
     <td>" . $row['sneaker'] . "</td>
     <td>" . $row['age'] . "</td>
     <td>" . $row['size'] . "</td>
     <td>" . $row['buy_shop'] . "</td>
     <td>" . $row['sell_shop'] . "</td>
     <td>" . $row['buying_price'] . "</td>
     <td>" . $row['selling_price'] . "</td>
     <td>" . $row['buy_account'] . "</td>
     <td>" . $row['profit_account'] . "</td>
     <td>" . $row['fees'] . "</td>
     <td>" . $row['rounded_with_hk'] . "</td>
     <td>" . $row['payout'] . "</td>
     <td>" . $row['profit'] . "</td>
     <td>" . $row['payout_on_sk'] . "</td>
     </tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
</div>
<div>
  <form>
    <input onclick="window.location.href='../sell/sell_page.php'" id ="button"  type="button" value="Sell another sneaker" />
  </form>
  <form>
    <input onclick="window.location.href='../buy/buy_page.php'" id ="button"  type="button" value="Buy another sneaker" />
  </form>
  <form>
    <input onclick="window.location.href='../index.html'" id ="button"  type="button" value="Home" />
  </form>
</div>

  </body>
</html>
