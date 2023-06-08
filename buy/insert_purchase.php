<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include '../db_config.php';
$link = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if($link === false){
   die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$brand = mysqli_real_escape_string($link, $_REQUEST['brand']);
$sku = mysqli_real_escape_string($link, $_REQUEST['sku']);
$modell = mysqli_real_escape_string($link, $_REQUEST['modell']);
$colorway = mysqli_real_escape_string($link, $_REQUEST['colorway']);
$condition = mysqli_real_escape_string($link, $_REQUEST['condition']);
$age = mysqli_real_escape_string($link, $_REQUEST['age']);
$buy_shop = mysqli_real_escape_string($link, $_REQUEST['buy_shop']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$buying_price = mysqli_real_escape_string($link, $_REQUEST['buying_price']);
$sold = 0; //mysqli_real_escape_string($link, $_REQUEST['0']);
$size = mysqli_real_escape_string($link, $_REQUEST['size']);
$purchaseInvoice = mysqli_real_escape_string($link, $_REQUEST['purchase_invoice']);
if ($purchaseInvoice == 1){
      $purchaseInvoice = 1;
} else {
$purchaseInvoice = 0;
}
// Attempt insert query execution

$sql = "INSERT INTO sneaker (brand, sku, modell, colorway, itemCondition, age, buy_shop, buy_date, buying_price, sold, size, sell_shop, selling_price, shipping_fee, transaction_fee, payout, profit, purchase_invoice)
VALUES ('$brand', '$sku', '$modell', '$colorway', '$condition', '$age', '$buy_shop', '$date', '$buying_price',
   '$sold', '$size', null, null, null, null, null, null, $purchaseInvoice)";

if(mysqli_query($link, $sql)){
   header('Location: success_buy.php');
   echo "Succes";
} else{
   echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

$sql2 = "INSERT INTO progress (`status`, payed, arrived, listing_item, sold_item, shipped_to_buyer, submit_sell_info, payout) VALUES (2,1,0,0,0,0,0,0)";
if(mysqli_query($link, $sql2)){
   echo "Succes";
} else{
   echo "ERROR: Not able to execute $sql2. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>