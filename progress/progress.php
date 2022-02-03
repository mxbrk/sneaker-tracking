<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Progress</title>
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
  .main-block {
  height: auto;
  border-radius: 20px;
  box-sizing: border-box;
  width: 350px;
  padding: 10px 0;
  margin: auto;
  background: #15172b;
  }
  form {
  margin: 0 30px;
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
    <div class ="main-block">
    <h1>Update progress</h1>
    <form action="update_progress.php" method="POST">
      <label id="icon" for="sneakerID"></label>
      <input type="number" name="sneakerID" id="sneakerID" placeholder="ID" step="1" required/>

      <label id="icon" for="status"></label>
      <select id="select" name="status">
        <option value="" disabled selected>Select the status</option>
        <option value="transfer_sk_to_hk">Transfered SK to HK</option>
        <option value="arrived">Arrived</option>
        <option value="listing_item">Listed for selling</option>
        <option value="sold_item">Sold</option>
        <option value="shipped_to_buyer">Shipped to buyer</option>
        <option value="authenticated_item">Authenticated</option>
        <option value="cashout_on_paypal">Cashout on Paypal</option>
        <option value="withdraw_on_hk">Withdraw on HK</option>
        <option value="submit_sell_info">Sell-info submitted</option>
        <option value="payout_on_sk">Payout on SK</option>
      </select>
      <div><br>
        <button id ="button" type="submit" value="Submit">Submit</button>
      </div>
    </form>
</div>
    <div class="table">
    <?php
    include '../db_config.php';
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT sneakerID,
    CASE WHEN paid_item = 1 THEN REPLACE(paid_item,1,'yes') ELSE REPLACE(paid_item,0, '') END as paid_item,
    CASE WHEN created_item_id = 1 THEN REPLACE(created_item_id,1,'yes') ELSE REPLACE(created_item_id,0, '') END as created_item_id,
    CASE WHEN transfer_sk_to_hk = 1 THEN REPLACE(transfer_sk_to_hk,1,'yes') ELSE REPLACE(transfer_sk_to_hk,0, '') END as transfer_sk_to_hk,
    CASE WHEN arrived = 1 THEN REPLACE(arrived,1,'yes') ELSE REPLACE(arrived,0, '') END as arrived,
    CASE WHEN listing_item = 1 THEN REPLACE(listing_item,1,'yes') ELSE REPLACE(listing_item,0, '') END as listing_item,
    CASE WHEN sold_item = 1 THEN REPLACE(sold_item,1,'yes') ELSE REPLACE(sold_item,0, '') END as sold_item,
    CASE WHEN shipped_to_buyer = 1 THEN REPLACE(shipped_to_buyer,1,'yes') ELSE REPLACE(shipped_to_buyer,0, '') END as shipped_to_buyer,
    CASE WHEN authenticated_item = 1 THEN REPLACE(authenticated_item,1,'yes') ELSE REPLACE(authenticated_item,0, '') END as authenticated_item,
    CASE WHEN cashout_on_paypal = 1 THEN REPLACE(cashout_on_paypal,1,'yes') ELSE REPLACE(cashout_on_paypal,0, '') END as cashout_on_paypal,
    CASE WHEN withdraw_on_hk = 1 THEN REPLACE(withdraw_on_hk,1,'yes') ELSE REPLACE(withdraw_on_hk,0, '') END as withdraw_on_hk,
    CASE WHEN submit_sell_info = 1 THEN REPLACE(submit_sell_info,1,'yes') ELSE REPLACE(submit_sell_info,0, '') END as submit_sell_info,
    CASE WHEN payout_on_sk = 1 THEN REPLACE(payout_on_sk,1,'yes') ELSE REPLACE(payout_on_sk,0, '') END as payout_on_sk
    FROM progress
    WHERE payout_on_sk = 0
    ORDER BY sneakerID DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo
      "<table>
      <tr>
      <th>ID</th>
      <th>Paid</th>
      <th>Buy-info submitted</th>
      <th>Transfer SK -> HK</th>
      <th>Arrived</th>
      <th>Listed</th>
      <th>Sold</th>
      <th>Shipped</th>
      <th>Authenticated</th>
      <th>Cashout on PP</th>
      <th>Withdraw on HK</th>
      <th>Sell-info submitted</th>
      <th>Payout on SK</th>
      </tr>";

 // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
     <td>" . $row['sneakerID'] . "</td>
     <td>" . $row['paid_item'] . "</td>
     <td>" . $row['created_item_id'] . "</td>
     <td>" . $row['transfer_sk_to_hk'] . "</td>
     <td>" . $row['arrived'] . "</td>
     <td>" . $row['listing_item'] . "</td>
     <td>" . $row['sold_item'] . "</td>
     <td>" . $row['shipped_to_buyer'] . "</td>
     <td>" . $row['authenticated_item'] . "</td>
     <td>" . $row['cashout_on_paypal'] . "</td>
     <td>" . $row['withdraw_on_hk'] . "</td>
     <td>" . $row['submit_sell_info'] . "</td>
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
    <input onclick="window.location.href='../numbers/numbers.php'" id ="button"  type="button" value="Numbers" />
  </form>
  <form>
    <input onclick="window.location.href='../index.html'" id ="button"  type="button" value="Home" />
  </form>

</div>

  </body>
</html>
