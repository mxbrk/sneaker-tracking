<?php
//session_destroy();
session_start();
include '../db_config.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}       
    $sneakerID = mysqli_real_escape_string($conn, $_REQUEST['sneakerID']);
    $sql = "SELECT brand FROM sneaker WHERE sneakerID =1;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
//        $_SESSION["sqlQuery"] = $sneakerID;
     $_SESSION["sqlQuery"] = $row["brand"];
      header('Location: edit_page.php');

         }
     } else {
       echo "0 results"; //error message mit timer, danach auf startseite zurückkehren
     }



/*
    if(mysqli_query($link, $sql)){
        $_SESSION["sqlQuery"] = $sql;
        header('Location: edit_page.php');
        echo "Succes";
     } else{
        echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
     }
  */   
?>