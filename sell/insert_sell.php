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
$sneakerID = mysqli_real_escape_string($link, $_REQUEST['sneakerID']);
$sell_date = mysqli_real_escape_string($link, $_REQUEST['sell_date']);
$sell_shop = mysqli_real_escape_string($link, $_REQUEST['sell_shop']);
$selling_price = mysqli_real_escape_string($link, $_REQUEST['selling_price']);
$shipping_fee = mysqli_real_escape_string($link, $_REQUEST['shipping_fee']);
$transaction_fee = mysqli_real_escape_string($link, $_REQUEST['transaction_fee']);
$sold = mysqli_real_escape_string($link, $_REQUEST['1']);
$payout = mysqli_real_escape_string($link, $_REQUEST['payout']);
$profit= mysqli_real_escape_string($link, $_REQUEST['profit']);
$invoice= mysqli_real_escape_string($link, $_REQUEST['invoiceNumber']);


// Attempt insert query execution
$sql = "UPDATE sneaker
SET sell_date = '$sell_date',
sell_shop = '$sell_shop',
selling_price = '$selling_price',
shipping_fee = '$shipping_fee',
transaction_fee = '$transaction_fee',
sold = '1',
payout = '$payout',
profit = '$profit',
invoiceNumber = '$invoice'
WHERE sneakerID = '$sneakerID'; ";
$sql .= "UPDATE progress SET status ='6', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";

if(mysqli_multi_query($link, $sql)){
   header('Location: success_sell.php');
   echo "Succes";
} else{
   echo "ERROR: Could not able to execute:  $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>