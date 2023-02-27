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
$status = mysqli_real_escape_string($link, $_REQUEST['status']);


switch ($status) {
    case "transfer_sk_to_hk":
      $sql1 = "UPDATE progress SET status ='2', arrived='0', listing_item='0', sold_item='0', shipped_to_buyer='0',submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql1)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql1. " . mysqli_error($link);
            }
        break;
    case "arrived":
      $sql2 = "UPDATE progress SET status ='4', arrived='1', listing_item='0', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql2)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql2. " . mysqli_error($link);
            }
        break;
    case "listing_item":
      $sql3 = "UPDATE progress SET status ='5', arrived='1', listing_item='1', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql3)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql3. " . mysqli_error($link);
            }
        break;
    case "sold_item":
      $sql4 = "UPDATE progress SET status ='6', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql4)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql4. " . mysqli_error($link);
            }
        break;
    case "shipped_to_buyer":
      $sql5 = "UPDATE progress SET  status ='7', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='0', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql5)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql5. " . mysqli_error($link);
            }
        break;
    case "submit_sell_info":
      $sql9 = "UPDATE progress SET status ='9' , arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql9)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql9. " . mysqli_error($link);
            }
        break;
    case "payout_on_sk":
      $sql10 = "UPDATE progress SET status ='8', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='1' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql10)){
               header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql10. " . mysqli_error($link);
            }
        break;
      case "delete_id":
      $sql11 = "DELETE FROM sneaker WHERE sneakerID = $sneakerID; ";
      $sql11 .= "DELETE FROM progress WHERE sneakerID = $sneakerID";
      if(mysqli_multi_query($link, $sql11)){
      header('Location: overview.php');
               echo "Succes";
            } else{
               echo "ERROR: Could not execute $sql11. " . mysqli_error($link);
            }
         break;
}
// Close connection
mysqli_close($link);
?>