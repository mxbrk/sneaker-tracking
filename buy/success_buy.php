<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\buy\success_buy.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Success-Buy</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
</head>

<body>
    <div class="category-info">
        <img src="greencheck.png" /><br>
        <?php
        include '../db_config.php';
          // Create connection
          $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT
        MAX(sneakerID) as sneakerID,
        CONCAT(brand,' ', modell,' ', colorway) as sneaker
        FROM sneaker
        WHERE sneakerID = (SELECT max(sneakerID) FROM sneaker)";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<h1>Your sneaker purchase '" . $row["sneaker"] . "' was succesfully created <br/> and was assigned the ID: " . $row["sneakerID"] . " </h1>";

          }
        } else {
         echo "0 results";
        }
        ?>
        <div>
            <form>
                <input onclick="window.location.href='buy_page.php'" id="button" type="button"
                    value="Buy another sneaker" />
            </form>
            <form>
                <input onclick="window.location.href='/overview/overview.php'" id="button" type="button"
                    value="Overview" />
            </form>

        </div>
</body>

</html>