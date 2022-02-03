<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("sql502.your-server.de", "sneakep_1", "zz357J55jA6y9U8x", "db_stbln");

// Check connection
if($link === false){
   die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security

// Attempt insert query execution
$sql = "DELETE FROM spendings";

if(mysqli_query($link, $sql)){
   header('Location: https://spendings.sneakertrackingberlin.de/');
   echo "Succes";
} else{
   echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
