<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Numbers</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
  <head>
    <style media="screen">
    html, body {
    background-color:#00001a;
    display: flex;
    justify-content: center;
    height: 100%;
    }
    body, div, h1, form, input, p, select {
    padding: 0;
    margin: 0;
    outline: none;
    font-family: Roboto, sans-serif;
    font-size: 16px;
    color: #eee;
    }
    h1 {
    padding: 10px 0;
    font-size: 32px;
    font-weight: 300;
    text-align: center;
    }
    p {
    font-size: 12px;
    }
    .main-block {
    height: auto;
    border-radius: 20px;
    box-sizing: border-box;
    width: 340px;
    min-height: 460px;
    padding: 10px 0;
    margin: auto;
    background: #15172b;
    }
    form {
    margin: 0 30px;
    }
    .placeholder{
    color: #65657b;
    font-family: sans-serif;
    left: 20px;
    top: 20px;
    }
    input[type=text], input[type=password], input[type=number], select , input[type=date]{
    margin: 13px 0 0 -5px;
    padding-left: 10px;
    background-color: #303245;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    font-size: 18px;
    height: 40px;
    padding: 4px 20px 0;
    width: 100%;
    -moz-appearance: textfield;
    }
    #button {
    background-color: #08d;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align: center;
    width: 100%;
    }
    #button:hover {
    background: #008cff;
    }
    </style>
  </head>
    </head>
    <body>
        <div class ="main-block">
          <h1>Numbers</h1>
            <?php
            include '../db_config.php';
            */$conn = mysqli_connect($servername, $username, $password, $dbname);

           if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $data_from = mysqli_real_escape_string($link, $_REQUEST['data_from']);
            $data_to = mysqli_real_escape_string($link, $_REQUEST['data_to']);


            $sql = "SELECT FORMAT(SUM(buying_price),0, 'de_DE')as buying_price,
            FORMAT(sum(selling_price),0, 'de_DE') as selling_price,
            FORMAT(sum(shipping_fee) + sum(transaction_fee),0, 'de_DE') as fees,
            FORMAT(sum(payout),0, 'de_DE') as payout,
            FORMAT(sum(profit),0, 'de_DE') as profit,
            FORMAT(sum(rounded_with_hk),0, 'de_DE') as roundedWithHK,
            FORMAT(sum(payout_on_sk),0, 'de_DE') as payoutOnSK,
            count(sneakerID) as amount
            FROM sneaker ";

            $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<hr>" .
                 "Invest: " . $row["buying_price"]. " €  " . "(".$row["amount"]." pairs)"."<br>" ."<br>" .
                 "Rounded with HK: " . $row["roundedWithHK"]. " €" . "<br>" ."<br>" .
                 "Payout on SK (complete timerange): " . $row["payoutOnSK"]. " €" . "<br>". "<br>";
               }
           } else {
             echo "0 results";
           }

           $sql2 = "SELECT count(sold) as sold,
           FORMAT(sum(buying_price),0, 'de_DE') as buying_price
           FROM sneaker WHERE sold = 0";

           $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
             // output data of each row
             while($row = $result2->fetch_assoc()) {
               echo "In stock: " .$row["buying_price"]. " €" . " (". $row["sold"]." pairs)"."<br>" .
               "<hr>";
                  }
                } else {
                  echo "0 results";
                }

           $sql3 = "SELECT
           count(sneakerID) as amount_sold,
           FORMAT(sum(selling_price),0, 'de_DE') as selling_price,
           FORMAT(sum(shipping_fee) + sum(transaction_fee),0, 'de_DE') as fees,
           FORMAT(sum(payout),0, 'de_DE') as payout,
           FORMAT(sum(profit),0, 'de_DE') as profit,
           FORMAT(sum(payout_on_sk),0, 'de_DE') as payout_on_sk,
           FORMAT(sum(buying_price),0, 'de_DE') as buying_price,
           ROUND( ((sum(profit) / sum(buying_price)) * 100), 2) as roi,
           FORMAT(ROUND(sum(profit) / (TIMESTAMPDIFF(MONTH, '2022-01-01', now()) +1), 0),0, 'de_DE') as avg_profit_month,
           FORMAT(ROUND(sum(payout_on_sk) / (TIMESTAMPDIFF(MONTH, '2022-01-01', now()) +1), 0),0, 'de_DE') as avg_payoutSK_month
           /*Implement AVG Bought/Sold pairs per month*/
           FROM sneaker WHERE sold = 1  AND sell_date >= '2022-01-01'";

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
               "  Payout on SK: " . $row["payout_on_sk"]. " €" . "<br>" ."<br>" .
               "  ROI: " . $row["roi"]. " %" . "<br>" ."<br>".
               "  (Selling price can differ up to 5% and" ."<br>".
               "  fees can differ up to 10%)" ."<br>" .
               "  <hr>" .
               "  Complete statistics:"."<br>" ."<br>" .
               "  Avg. profit/month: " . $row["avg_profit_month"]. " €" . "<br>" . "<br>" .
               "  Avg. payout on SK/month: " . $row["avg_payoutSK_month"]. " €" . "<br>". "<br>";
          }
        } else {
          echo "0 results";
        }

        $sql4 = "SELECT
        ROUND(count(sneakerID) / (TIMESTAMPDIFF(MONTH, '2022-01-01', now()) +1), 1) as avg_bought_month
        FROM sneaker WHERE buy_date >= '2022-01-01'";

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
         ROUND(count(sold) / (TIMESTAMPDIFF(MONTH, '2022-01-01', now()) +1), 1) as avg_sold_month
         FROM sneaker WHERE sold = 1 AND sell_date >= '2022-01-01'";

         $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) {
           // output data of each row
           while($row = $result5->fetch_assoc()) {
             echo "Avg. sold sneaker/month: " .$row["avg_sold_month"]."<br>". "<br>";
                }
              } else {
                echo "0 results";
              }

      $conn->close();
      ?>

      </form>
      <form action="public_html/index.html/">
        <input onclick="window.location.href='../index.html'" id ="button"  type="button" value="Go to homepage" />
      </form>
    </div>
</body>
</html>
