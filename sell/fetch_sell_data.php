<?php
session_start();
include '../db_config.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sneakerID = mysqli_real_escape_string($conn, $_REQUEST['sneakerID']);
$sql = "SELECT * FROM sneaker WHERE sneakerID =" . "$sneakerID" . ";";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $_SESSION['sql'] = array(
      "sneakerID" => $row["sneakerID"],
      "buying_price" => $row["buying_price"],
      "sell_date" => $row["sell_date"],
      "sell_shop" => $row["sell_shop"],
      "selling_price" => $row["selling_price"],
      "payout" => $row["payout"],
      "shipping_fee" => $row["shipping_fee"],
      "transaction_fee" => $row["transaction_fee"],
      "profit" => $row["profit"],
      "invoiceNumber" => $row["invoiceNumber"]
    );
    header('Location: sell_page.php');

  }
} else {
  echo "0 results"; //IDEA: error message mit timer, danach auf startseite zurückkehren
}
?>