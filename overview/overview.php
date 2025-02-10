<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STB-Overview</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/searchFunction.js"></script>
<script src="../js/updateIDAlert.js"></script>
<style>
    .light-grey {
        background-color: #e5e5e5;
        border-radius: 15px;
    }

    .Level1 {
        color: #ff2d00;
        background-color: #ff2d00;
        border-radius: 15px;
    }

    .Level2 {
        color: #ff6100;
        background-color: #ff6100;
        border-radius: 15px;
    }

    .Level3 {
        color: #ff8f00;
        background-color: #ff8f00;
        border-radius: 15px;
    }

    .Level4 {
        color: #ffd400;
        background-color: #ffd400;
        border-radius: 15px;
    }

    .Level5 {
        color: #a9ff00;
        background-color: #a9ff00;
        border-radius: 15px;
    }

    .Level6 {
        color: #61d500;
        background-color: #61d500;
        border-radius: 15px;
    }

    .Level7 {
        color: #03c200;
        background-color: #03c200;
        border-radius: 15px;
    }
    .text-custom {
        color: #d14124 !important;
    }

    .border-custom {
        border-color: #d14124 !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <div class="container-fluid">
        <img src="logo.png" width="100" height="60" class="d-inline-block align-top" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link text-dark" href="../index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/stores/stores.html">Stores</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/buy/buy_page.php">Buy</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/sell/sell_landing_page.php">Sell</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/numbers/numbers.php">Numbers</a></li>
                <li class="nav-item"><a class="nav-link text-custom border-bottom border-custom"
                        href="/overview/overview.php">Overview</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/edit/edit_landing_page.php">Edit</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/tools/tools.php">Tools</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="table-responsive">
    <form id="submitForm" action="update_progress.php" onsubmit="return approveAlert()" method="POST">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <select id="select" name="status" class="form-select w-auto">
                    <option value="" disabled selected>Select the status</option>
                    <option value="delete_id">Delete ID</option>
                    <option value="unsold">Unsold</option>
                    <option value="payed">Payed</option>
                    <option value="arrived">Arrived</option>
                    <option value="listing_item">Listed for selling</option>
                    <option value="sold_item">Sold</option>
                    <option value="shipped_to_buyer">Shipped to buyer</option>
                    <option value="payout">Payout</option>
                    <option value="submit_sell_info">Sell-info submitted</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="search" id="searchInput" onkeyup="searchFunction()" placeholder="Search for sneaker"
                class="form-control mr-sm-2 w-auto">
        </div>
</div>
<div class="table-responsive">
    <table id="myTable" class="table table-light table-striped table-hover">
        <thead>
            <tr>
                <th></th>
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
                <th>Status</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../db_config.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT sneaker.sneakerID,CONCAT(sneaker.brand,' ', sneaker.modell,' ', sneaker.colorway) as sneaker,
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
                while ($row = $result->fetch_assoc()) {
                    $row['purchase_invoice'] = str_replace("0", "", $row['purchase_invoice']);
                    $row['purchase_invoice'] = str_replace("1", "<span style='color:green;'>&#10004;</span>", $row['purchase_invoice']);

                    echo "<tr>";
                    echo "<td><input type='checkbox' name='sneakerIDs[]' class='sneakerCheckbox' value='" . $row['sneakerID'] . "'></td>";
                    echo "<td>" . $row['sneakerID'] . "</td>";
                    echo "<td>" . $row['sneaker'] = str_replace("*", "<span style='color:red;'>*</span>", $row['sneaker']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sku']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['itemCondition']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['size']) . "</td>";
                    echo "<td>" . $row['purchase_invoice'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['buy_shop']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['sell_shop']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['buying_price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['selling_price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fees']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['payout']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['profit']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['invoiceNumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['statusName']) . "</td>";
                    echo "<td>" . '<div style="width:"100%" class="light-grey"><div class="' . $row['statusColor'] . '" style="width:' . $row['status'] . '%">' . $row['status'] . '</div></div>' .
                        "</td>
     </tr>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='18' class='text-center'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</form>
</div>
</body>

</html>