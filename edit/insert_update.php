<?php
session_start();
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
$age = mysqli_real_escape_string($link, $_REQUEST['age']);
$buy_shop = mysqli_real_escape_string($link, $_REQUEST['buy_shop']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$buying_price = mysqli_real_escape_string($link, $_REQUEST['buying_price']);
$sold = 0; //mysqli_real_escape_string($link, $_REQUEST['0']);
$size = mysqli_real_escape_string($link, $_REQUEST['size']);
// Attempt insert query execution
$sneakerInfo = $_SESSION['sql'];
$sql = "UPDATE sneaker SET brand = '$brand', sku = '$sku', modell = '$modell', colorway = '$colorway', age = '$age', buy_shop = '$buy_shop', buy_date = '$date', buying_price = '$buying_price',  size = '$size' WHERE sneakerID =" . $sneakerInfo[sneakerID] . ";";

if(mysqli_query($link, $sql)){
   header('Location: ..\overview\overview.php');
   echo "Succes";
} else{
   echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>