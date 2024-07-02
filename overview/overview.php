<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\overview.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Overview</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <script src="..\js\searchFunction.js"></script>
    <script src="..\js\updateIDAlert.js"></script>
</head>

<body>
    <h1>Overview</h1>
    <nav>
        <input type="checkbox" id="burger">
        <ul id="navigation">
            <li><a href="../index.html">Home</a> </li>
            <li><a href="/stores/stores.html">Stores</a> </li>
            <li><a href="/buy/buy_page.php">Buy</a> </li>
            <li><a href="/sell/sell_landing_page.php">Sell</a> </li>
            <li><a href="/numbers/numbers.php">Numbers</a> </li>
            <li><a href="/overview/overview.php">Overview</a> </li>
            <li><a href="/edit/edit_landing_page.php">Edit</a> </li>
            <li><a href="/tools/tools.php">Tools</a> </li>
        </ul>
    </nav>
    <div>
        <form id="submitForm" action="update_progress.php" onsubmit="return approveAlert(this)" method="POST">
            <input type="number" name="sneakerID" id="sneakerID" placeholder="ID" step="1" required autofocus />
            <select id="select" name="status" required>
                <option value="" disabled selected>Select the status</option>
                <option value="delete_id">Delete ID</option>
                <option value="unsold">Unsold</option>
                <option value="payed">Payed</option>
                <option value="arrived">Arrived</option>
                <option value="listing_item">Listed for selling</option>
                <option value="sold_item">Sold</option>
                <option value="shipped_to_buyer">Shipped to buyer</option>
                <option value="payout">Payout</option>
                <option style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px"
                    value="submit_sell_info">Sell-info submitted</option>
            </select>
            <button id="button" type="submit" value="Submit">Submit</button>
        </form>
        <form id="searchSneaker">
            <input type="search" id="searchInput" onkeyup="searchFunction()" placeholder="Search for sneaker">
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
        $sql = "SELECT sneaker.sneakerID,CONCAT(sneaker.brand,' ', sneaker.modell,' ', sneaker.colorway)
    as sneaker,
    sneaker.sku,
    CASE sneaker.itemCondition
    WHEN 'deadstock' THEN 'DS' 
    ELSE 'Used' 
    END as itemCondition,
    sneaker.age,
    sneaker.size,
    sneaker.purchase_invoice,
    CASE sneaker.buy_shop
    WHEN 'Vinted-System' THEN 'V. System' 
    ELSE sneaker.buy_shop
    END as buy_shop,
    CASE sneaker.sell_shop
    WHEN 'Vinted-System' THEN 'V. System' 
    ELSE sneaker.sell_shop
    END as sell_shop,
    FORMAT(sneaker.buying_price,2, 'de_DE') as buying_price,
    FORMAT(sneaker.selling_price,2, 'de_DE') as selling_price,
    FORMAT((sneaker.shipping_fee + sneaker.transaction_fee),2, 'de_DE') as fees,
    FORMAT((sneaker.payout),2, 'de_DE') as payout,
    FORMAT((sneaker.profit),2, 'de_DE') as profit, 
    CONCAT('#',sneaker.invoiceNumber) as invoiceNumber,
    CASE progress.status
     WHEN 9 THEN 'sell info submitted'
     WHEN 8 THEN 'payout'
     WHEN 7 THEN 'shipped'
     WHEN 6 THEN 'sold'
     WHEN 5 THEN 'listed'
     WHEN 4 THEN 'arrived'
     WHEN 2 THEN 'payed'
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
      <th>SKU</th>
      <th>Condition</th>
      <th>Age</th>
      <th>Size</th>
      <th>Invoice</th>
      <th>Buy shop</th>
      <th>Sell shop</th>
      <th>Buy price</th>
      <th>Sell price</th>
      <th>Fees</th>
      <th>Payout</th>
      <th>Profit</th>
      <th>Sales-Inv.</th>
      <th style="width:120px">Status</th>
      <th style="width:150px" >Progress</th>
      </tr>';

            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $row['sneaker'] = str_replace("*", "<span style='color:red;'>*</span>", $row['sneaker']);
                $row['purchase_invoice'] = str_replace("0", "", $row['purchase_invoice']);
                $row['purchase_invoice'] = str_replace("1", "<span style='color:green;'>&#10004;</span>", $row['purchase_invoice']);

                echo "<tr>
     <td>" . $row['sneakerID'] . "</td>
     <td>" . $row['sneaker'] . "</td>
     <td>" . $row['sku'] . "</td>
     <td>" . $row['itemCondition'] . "</td>
     <td>" . $row['age'] . "</td>
     <td>" . $row['size'] . "</td>
     <td>" . $row['purchase_invoice'] . "</td>
     <td>" . $row['buy_shop'] . "</td>
     <td>" . $row['sell_shop'] . "</td>
     <td>" . $row['buying_price'] . "</td>
     <td>" . $row['selling_price'] . "</td>
     <td>" . $row['fees'] . "</td>
     <td>" . $row['payout'] . "</td>
     <td>" . $row['profit'] . "</td>
     <td>" . $row['invoiceNumber'] . '</td>

     <td style="font-size:14px">' . $row['statusName'] . '</td>
     <td>' . '<div style="width:"100%" class="light-grey"><div class="' . $row['statusColor'] . '" style="width:' . $row['status'] . '%">' . $row['status'] . '</div></div>' .
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
    <div>
        <p><span style='color:red;'>*</span> <span style='color:white;'>= These sneakers are from the deposit and only
                the
                profit remains on the corporate bank account.
                <br> The amount of the purchase price goes back to SK with an indication of the old ID.</span> </p>
    </div>
</body>

</html>