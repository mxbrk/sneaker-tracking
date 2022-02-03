<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spendings</title>
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
    width: 395px;
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
    #button_reset {
    background-color: #d03f44;
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
    #button_reset:hover {
    background:#e91640;
    }
    table{
    border-collapse: collapse;
    }
    th{
    Color:white;
    }
    th, td{
    width:350px;
    text-align:center;
    border:none;
    padding:5px
    }
    </style>
  </head>
    </head>
    <body>
        <div class ="main-block">
          <h1>Monthly spendings</h1>
          <form action="insert_spending.php" method="POST">
            <label id="icon" for="amount"></label>
            <input type="number" name="amount" id="amount" placeholder="Amount" step="0.01" required/>

            <label id="icon" for="description"></label>
            <input type="text" name="description" id="description" placeholder="Description" required/>

            <label id="icon" for="date"></label>
            <input type="text" name="date" id="date" name="date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')"/>

            <div><br>
              <button id ="button" type="submit" value="Submit">Submit</button>
            </div>
          </form>

          <form>
          <?php
              $servername = "sql502.your-server.de";
              $username = "sneakep_1";
              $password = "zz357J55jA6y9U8x";
              $dbname = "db_stbln";
              // Create connection
              $conn = mysqli_connect($servername, $username, $password, $dbname);

           if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT SUM(amount) as amount,
            (500 - sum(amount)) as remains
            FROM spendings ";

            $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<hr>" .
                 "Spend: " . $row["amount"]. " €  " . "<br>" . "<br>" .
                 "Remains: " . $row["remains"]. " €" . "<br>" .
                 "<hr>";
               }
           } else {
             echo "0 results";
           }

           $sql2 = "SELECT amount,
           description,
           DATE_FORMAT(date, '%d.%m.%y') as date
           FROM spendings";

       $result2 = $conn->query($sql2);
       if ($result2->num_rows > 0) {
           echo
             "<table>
             <tr>
             <th>Amount</th>
             <th>Description</th>
             <th>Date</th>
             </tr>";

        // output data of each row
         while($row = $result2->fetch_assoc()) {
           echo "<tr>
            <td>" . $row['amount'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['date'] . "</td>
            </tr>";
           }
           echo "</table>";
         } else {
           echo "0 results";
         }

      $conn->close();

      ?>
      </form>
      <form action="reset_spendings.php" method="POST">
        <div>
          <button id ="button_reset" type="submit" value="submit" onclick="return confirm('Are you sure you want to reset the spendings?')">Reset spendings</button>
        </div>
      </form>

    </div>
  <!--select  (sum(payout)- sum(buying_price)) as profit_per_month from sneaker WHERE sell_date BETWEEN '2021-06-01' AND '2021-06-30' AND sold = 1*/-->
</body>
</html>
