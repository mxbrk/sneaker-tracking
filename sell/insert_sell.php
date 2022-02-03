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
$profit_account = mysqli_real_escape_string($link, $_REQUEST['profit_account']);
$shipping_fee = mysqli_real_escape_string($link, $_REQUEST['shipping_fee']);
$transaction_fee = mysqli_real_escape_string($link, $_REQUEST['transaction_fee']);
$brounded_with_hk = mysqli_real_escape_string($link, $_REQUEST['rounded_with_hk']);
$sold = mysqli_real_escape_string($link, $_REQUEST['1']);
$payout = mysqli_real_escape_string($link, $_REQUEST['payout']);
$profit= mysqli_real_escape_string($link, $_REQUEST['profit']);
$payout_on_sk = mysqli_real_escape_string($link, $_REQUEST['payout_on_sk']);

// Attempt insert query execution
$sql = "UPDATE sneaker
SET sell_date = '$sell_date',
sell_shop = '$sell_shop',
selling_price = '$selling_price',
profit_account = '$profit_account',
shipping_fee = '$shipping_fee',
transaction_fee = '$transaction_fee',
rounded_with_hk = '$brounded_with_hk',
sold = '1',
payout = '$payout',
profit = '$profit',
payout_on_sk = '$payout_on_sk'
WHERE sneakerID = '$sneakerID'";

if(mysqli_query($link, $sql)){
   header('Location: success_sell.php');
   echo "Succes";
} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
