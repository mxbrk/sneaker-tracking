<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\numbers.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Numbers</title>
    <link rel="shortcut icon" href="\Sneaker_Red.png">
    <style media="screen"></style>
</head>


<body>
    <div class="main-block">
        <h1>Numbers</h1>
        <?php
            include '../db_config.php';
            $conn = mysqli_connect($servername, $username, $password, $dbname);

           if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT FORMAT(SUM(buying_price),2, 'de_DE')as buying_price,
            FORMAT(sum(selling_price),2, 'de_DE') as selling_price,
            FORMAT(sum(shipping_fee) + sum(transaction_fee),2, 'de_DE') as fees,
            FORMAT(sum(payout),2, 'de_DE') as payout,
            FORMAT(sum(profit),2, 'de_DE') as profit,
            count(sneakerID) as amount
            FROM sneaker";

            $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<hr>" .
                 "Invest  (since 20.02.2023): " . $row["buying_price"]. " €  " . "/ ".$row["amount"]." pairs"."<br>" ."<br>" .
                 "Payout  (since 20.02.2023): " . $row["payout"]. " €" . "<br>". "<br>";
               }
           } else {
             echo "0 results";
           }

           $sql2 = "SELECT count(sold) as sold,
           FORMAT(sum(buying_price),2, 'de_DE') as buying_price
           FROM sneaker WHERE sold = 0";

           $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
             // output data of each row
             while($row = $result2->fetch_assoc()) {
               echo "In stock: " .$row["buying_price"]. " €" . " / ". $row["sold"]." pairs"."<br>"."<br>"  .
               "The inventory started with 27 pairs" ."<br>" .
               "<hr>";
                  }
                } else {
                  echo "0 results";
                }

           $sql3 = "SELECT
           count(sneakerID) as amount_sold,
           FORMAT(sum(selling_price),2, 'de_DE') as selling_price,
           FORMAT(sum(shipping_fee) + sum(transaction_fee),2, 'de_DE') as fees,
           FORMAT(sum(payout),2, 'de_DE') as payout,
           FORMAT(sum(profit),2, 'de_DE') as profit,
           FORMAT(sum(buying_price),2, 'de_DE') as buying_price,
           ROUND( ((sum(profit) / sum(buying_price)) * 100), 2) as roi,
           ROUND( ((sum(profit) / sum(selling_price)) * 100), 2) as ros,
           FORMAT(ROUND(sum(profit) / (TIMESTAMPDIFF(MONTH, '2023-02-21', now()) +1), 2),2, 'de_DE') as avg_profit_month
           /*Implement AVG Bought/Sold pairs per month*/
           FROM sneaker WHERE sold = 1  AND sell_date >= '2023-02-21'";

           $result3 = $conn->query($sql3);
           if ($result3->num_rows > 0) {
             // output data of each row
             while($row = $result3->fetch_assoc()) {
          echo
               "  Sneakers sold: " .$row["amount_sold"]."<br>" ."<br>" .
               "  Bought for: ".$row["buying_price"]." €". "<br>" ."<br>" .
               "  Sold for: " .$row["selling_price"]." €" . "<br>" ."<br>" .
               "  Fees: " . $row["fees"]. " €" . "<br>" ."<br>" .
               "  Payout: ".$row["payout"]." €". "<br>" ."<br>" .
               "  Profit: " . $row["profit"]. " €" . "<br>" ."<br>" .
               "  ROI: " . $row["roi"]. " %" . "<br>" ."<br>".
               "  ROS: " . $row["ros"]. " %" . "<br>" ."<br>".
               "  (Selling price can differ up to 5% and" ."<br>".
               "  fees can differ up to 10%)" ."<br>" .
               "  <hr>" .
               "  Statistics:"."<br>" ."<br>" .
               "  Avg. profit/month: " . $row["avg_profit_month"]. " €" . "<br>" . "<br>";
          }
        } else {
          echo "0 results";
        }

        $sql4 = "SELECT
        ROUND(count(sneakerID) / (TIMESTAMPDIFF(MONTH, '2023-02-21', now()) +1), 2) as avg_bought_month
        FROM sneaker WHERE buy_date >= '2023-02-21'";

        $result4 = $conn->query($sql4);
       if ($result4->num_rows > 0) {
          // output data of each row
          while($row = $result4->fetch_assoc()) {
            echo "Avg. bought sneaker/month: " .$row["avg_bought_month"]."<br>". "<br>";
               }
             } else {
               echo "0 results";
             }
         $sql5 = "SELECT
         ROUND(count(sold) / (TIMESTAMPDIFF(MONTH, '2023-02-21', now()) +1), 2) as avg_sold_month
         FROM sneaker WHERE sold = 1 AND sell_date >= '2023-02-21'";

         $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) {
           // output data of each row
           while($row = $result5->fetch_assoc()) {
             echo "Avg. sold sneaker/month: " .$row["avg_sold_month"]."<br>". "<br>";
                }
              } else {
                echo "0 results";
              }
        $sql6 = "SELECT ROUND(AVG(DATEDIFF(`sell_date`, `buy_date`)),0) as 'tts'FROM `sneaker` WHERE sold = 1 AND colorway NOT LIKE '%*%'";
        $result6 = $conn->query($sql6);
        if ($result6->num_rows > 0) {
          // output data of each row
          while($row = $result6->fetch_assoc()) {
            echo "Avg. TTS in days: " .$row["tts"]. " (deposit sneaker exluded)" ."<br>". "<br>";
                }
              } else {
                echo "0 results";
              }
     
      $conn->close();
      ?>

        </form>
        <form action="public_html/index.html/">
            <input onclick="window.location.href='../index.html'" id="button" type="button" value="Home" />
        </form>
    </div>
</body>

</html>