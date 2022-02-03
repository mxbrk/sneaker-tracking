<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("servername", "username", "password", "database");

// Check connection
if($link === false){
   die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$sneakerID = mysqli_real_escape_string($link, $_REQUEST['sneakerID']);
$status = mysqli_real_escape_string($link, $_REQUEST['status']);


switch ($status) {
    case "transfer_sk_to_hk":
      $sql1 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='0', listing_item='0', sold_item='0', shipped_to_buyer='0', authenticated_item='0', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql1)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
            }
        break;
    case "arrived":
      $sql2 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='0', sold_item='0', shipped_to_buyer='0', authenticated_item='0', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql2)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
            }
        break;
    case "listing_item":
      $sql3 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='0', shipped_to_buyer='0', authenticated_item='0', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql3)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);
            }
        break;
    case "sold_item":
      $sql4 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='0', authenticated_item='0', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql4)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql4. " . mysqli_error($link);
            }
        break;
    case "shipped_to_buyer":
      $sql5 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='0', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql5)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql5. " . mysqli_error($link);
            }
        break;
    case "authenticated_item":
        $sql6 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='1', cashout_on_paypal='0', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql6)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql6. " . mysqli_error($link);
            }
        break;
    case "cashout_on_paypal":
      $sql7 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='1', cashout_on_paypal='1', withdraw_on_hk='0', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql7)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql7. " . mysqli_error($link);
            }
        break;
    case "withdraw_on_hk":
      $sql8 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='1', cashout_on_paypal='1', withdraw_on_hk='1', submit_sell_info='0', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql8)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql8. " . mysqli_error($link);
            }
        break;
    case "submit_sell_info":
      $sql9 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='1', cashout_on_paypal='1', withdraw_on_hk='1', submit_sell_info='1', payout_on_sk='0' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql9)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql9. " . mysqli_error($link);
            }
        break;
    case "payout_on_sk":
      $sql10 = "UPDATE progress SET transfer_sk_to_hk='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', authenticated_item='1', cashout_on_paypal='1', withdraw_on_hk='1', submit_sell_info='1', payout_on_sk='1' WHERE sneakerID = '$sneakerID'";
            if(mysqli_query($link, $sql10)){
               header('Location: https://progress.sneakertrackingberlin.de/');
               echo "Succes";
            } else{
               echo "ERROR: Could not able to execute $sql10. " . mysqli_error($link);
            }
        break;

}
// Close connection
mysqli_close($link);
?>
