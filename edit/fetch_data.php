<?php
session_start();
include '../db_config.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}       
    $sneakerID = mysqli_real_escape_string($conn, $_REQUEST['sneakerID']);
    $sql = "SELECT * FROM sneaker WHERE sneakerID =" .  "$sneakerID" .";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     $_SESSION['sql'] = array(
        "sneakerID" => $row["sneakerID"],
        "brand" => $row["brand"],
        "sku" => $row["sku"],
        "modell" => $row["modell"],
        "condition" => $row["itemCondition"],
        "age" => $row["age"],
        "colorway" => $row["colorway"],
        "buy_shop" => $row["buy_shop"],
        "buy_date" => $row["buy_date"],
        "size" => $row["size"],
        "buying_price" => $row["buying_price"],
        "purchase_invoice" => $row["purchase_invoice"]
     );
      header('Location: edit_page.php');

         }
     } else {
       echo "0 results"; //IDEA: error message mit timer, danach auf startseite zurückkehren
     }
?>