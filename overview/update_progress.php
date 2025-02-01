<?php
include '../db_config.php';
$link = mysqli_connect($servername, $username, $password, $dbname);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Empfange die JSON-Daten
$sneakerIDs = json_decode($_POST['sneakerIDs'], true);
$status = mysqli_real_escape_string($link, $_POST['status']);

if (empty($sneakerIDs) || empty($status)) {
    die("ERROR: Keine gültigen Daten empfangen.");
}

// Status Mapping
$statusMapping = [
    "payed" => "SET status ='2', payed='1', arrived='0', listing_item='0', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0'",
    "arrived" => "SET status ='4', payed='1', arrived='1', listing_item='0', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0'",
    "listing_item" => "SET status ='5', payed='1', arrived='1', listing_item='1', sold_item='0', shipped_to_buyer='0', submit_sell_info='0', payout='0'",
    "sold_item" => "SET status ='6', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='0', submit_sell_info='0', payout='0'",
    "shipped_to_buyer" => "SET status ='7', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='0', payout='0'",
    "submit_sell_info" => "SET status ='9', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='0'",
    "payout" => "SET status ='8', payed='1', arrived='1', listing_item='1', sold_item='1', shipped_to_buyer='1', submit_sell_info='1', payout='1'"
];

if ($status === "delete_id") {
    $sql = "DELETE FROM sneaker WHERE sneakerID IN (" . implode(",", array_map('intval', $sneakerIDs)) . ")";
    $sql .= "; DELETE FROM progress WHERE sneakerID IN (" . implode(",", array_map('intval', $sneakerIDs)) . ")";
} elseif (isset($statusMapping[$status])) {
    $sql = "UPDATE progress " . $statusMapping[$status] . " WHERE sneakerID IN (" . implode(",", array_map('intval', $sneakerIDs)) . ")";
} else {
    die("ERROR: Ungültiger Status.");
}

if (mysqli_multi_query($link, $sql)) {
    echo "Success";
} else {
    echo "ERROR: " . mysqli_error($link);
}

mysqli_close($link);
?>