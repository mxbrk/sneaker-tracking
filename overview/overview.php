<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Overview</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
</head>
<style media="screen">
</style>

<body>
    <h1>Overview</h1>
    <nav>
        <input type="checkbox" id="burger">
        <ul id="navigation">
            <li><a href="../index.html">Home</a> </li>
            <li><a href="/stores/stores.html">Stores</a> </li>
            <li><a href="/buy/buy_page.php">Buy</a> </li>
            <li><a href="/sell/sell_page.php">Sell</a> </li>
            <li><a href="/numbers/numbers.php">Numbers</a> </li>
            <li><a href="/overview/overview.php">Overview</a> </li>
            <li><a href="/progress/progress.php">Progress</a> </li>
        </ul>
    </nav>
    <div class="wrapperForm">
        <form id="submitForm" action="update_progress.php" onsubmit="return approveDelete(this)" method="POST">

            <label id="icon" for="sneakerID"></label>
            <input type="number" name="sneakerID" id="sneakerID" placeholder="ID" step="1" required />
            <label id="icon" for="status"></label>

            <select id="select" name="status">
                <option value="" disabled selected>Select the status</option>
                <option value="delete_id">Delete ID</option>
                <option value="transfer_sk_to_hk">Transfered SK to HK</option>
                <option value="arrived">Arrived</option>
                <option value="listing_item">Listed for selling</option>
                <option value="sold_item">Sold</option>
                <option value="shipped_to_buyer">Shipped to buyer</option>
                <option value="submit_sell_info">Sell-info submitted</option>
                <option style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px" value="payout_on_sk">
                    Payout on SK</option>
            </select>
            <button id="button" type="submit" value="Submit">Submit</button>
        </form>
    </div>

    <input type="search" id="searchInput" onkeyup="searchFunction()" placeholder="Search for sneaker...">

    <div class="table">
        <?php
    include '../db_config.php';
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT sneaker.sneakerID,CONCAT(sneaker.brand,' ', sneaker.modell,' ', sneaker.colorway)
    as sneaker,
    sneaker.age,
    sneaker.size,
    sneaker.buy_shop,
    sneaker.sell_shop ,
    sneaker.buying_price,
    sneaker.selling_price,
    sneaker.buy_account,
    sneaker.profit_account,
    sneaker.shipping_fee + sneaker.transaction_fee as fees,
    sneaker.rounded_with_hk,sneaker.payout,sneaker.profit,sneaker.payout_on_sk,
    CASE progress.status
     WHEN 9 THEN 'sell info submitted'
     WHEN 8 THEN 'payout on SK'
     WHEN 7 THEN 'shipped'
     WHEN 6 THEN 'sold'
     WHEN 5 THEN 'listed'
     WHEN 4 THEN 'arrived'
     WHEN 2 THEN 'payed (HK -> SK)'
    ELSE  0
    END as statusName,
    CASE progress.status
     WHEN 9 THEN 100
     WHEN 8 THEN 85
     WHEN 7 THEN 70
     WHEN 6 THEN 55
     WHEN 5 THEN 40
     WHEN 4 THEN 25
     WHEN 2 THEN 12
    ELSE  0
    END as status,
    CASE progress.status
     WHEN 9 THEN 'Level7'
     WHEN 8 THEN 'Level6'
     WHEN 7 THEN 'Level5'
     WHEN 6 THEN 'Level4'
     WHEN 5 THEN 'Level3'
     WHEN 4 THEN 'Level2'
     WHEN 2 THEN 'Level1'
    ELSE  '.'
    END as statusColor
    FROM sneaker
    LEFT JOIN progress ON sneaker.sneakerID=progress.sneakerID
    ORDER BY sneaker.sold ASC, sneaker.sneakerID ASC";


$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo
      '<table id="myTable">
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
      <th style="width:120px">Status</th>
      <th style="width:150px" >Progress</th>
      </tr>';

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
     <td>" . $row['payout_on_sk'] . '</td>
     <td style="font-size:14px">' . $row['statusName'] . '</td>
     <td>' .'<div style="width:"100%" class="light-grey"><div class="' .$row['statusColor'] . '" style="width:' . $row['status'] . '%">' . $row['status'] . '</div></div>'.
     "</td>
     </tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
    </div>
    <<?php
echo '<script>
function searchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function approveDelete(){
  var selectedOptionValue = document.getElementById("select");
  var value = selectedOptionValue.value;
  var sneakerID = document.getElementById("sneakerID").value;
debugger;
    if (value === "delete_id"){
      if (confirm("Do you want to delete " + sneakerID + " ?")) {
        return true;
      } else {
        return false;
      }
    }
}
</script>'
?> </body>

</html>