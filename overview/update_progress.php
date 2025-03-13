<?php
include '../db_config.php';
$link = mysqli_connect($servername, $username, $password, $dbname);

if($link === false){
   die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(!empty($_POST['sneakerIDs']) && isset($_POST['status'])) {
    $sneakerIDs = $_POST['sneakerIDs'];
    $status = mysqli_real_escape_string($link, $_POST['status']);
    $idList = implode(",", array_map('intval', $sneakerIDs));
    
    $updateQueries = [
        "payed" => "UPDATE progress SET status ='2', payed='1', arrived='0', listing_item='0', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList)",
        "arrived" => "UPDATE progress SET status ='4', payed='1', arrived='1', listing_item='0', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList)",
        "listing_item" => "UPDATE progress SET status ='5', payed='1', arrived='1', listing_item='1', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList)",
        "sold_item" => "UPDATE progress SET status ='6', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList)",
        "shipped_to_buyer" => "UPDATE progress SET status ='7', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList)",
        "submit_sell_info" => "UPDATE progress SET status ='9', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='0' WHERE sneakerID IN ($idList)",
        "payout" => "UPDATE progress SET status ='8', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='1' WHERE sneakerID IN ($idList)",
        "delete_id" => "DELETE FROM sneaker WHERE sneakerID IN ($idList); DELETE FROM progress WHERE sneakerID IN ($idList)",
        "unsold" => "UPDATE progress SET status ='5', payed='1', arrived='1', listing_item='1', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0' WHERE sneakerID IN ($idList); UPDATE sneaker SET sold='0', sell_shop=NULL, sell_date=NULL, selling_price=NULL, shipping_fee=NULL, transaction_fee=NULL, payout=NULL, profit=NULL, invoiceNumber=NULL WHERE sneakerID IN ($idList)"
    ];
    
    if(isset($updateQueries[$status])) {
        if(mysqli_multi_query($link, $updateQueries[$status])){
            header('Location: overview.php');
            echo "Success";
        } else{
            echo "ERROR: Could not execute query. " . mysqli_error($link);
        }
    }
}

mysqli_close($link);
?>