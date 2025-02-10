<?php
// Datenbankverbindung
$servername = "servername";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-Abfragen ohne FORMAT
$sql = "SELECT 
            SUM(buying_price) as buying_price,
            SUM(selling_price) as selling_price,
            SUM(shipping_fee) + SUM(transaction_fee) as fees,
            SUM(payout) as payout,
            SUM(profit) as profit,
            max(invoiceNumber) as invoiceNumber,
            COUNT(sneakerID) as amount
            FROM sneaker";
            
$sql2 = "SELECT count(sold) as sold,
           SUM(buying_price) as buying_price
           FROM sneaker WHERE sold = 0";

$sql3 = "SELECT
           COUNT(sneakerID) as amount_sold,
           SUM(selling_price) as selling_price,
           SUM(shipping_fee) + SUM(transaction_fee) as fees,
           SUM(payout) as payout,
           SUM(profit) as profit,
           SUM(buying_price) as buying_price,
           ROUND( ((SUM(profit) / SUM(buying_price)) * 100), 2) as roi,
           ROUND( ((SUM(profit) / SUM(payout)) * 100), 2) as ros,
           ROUND(SUM(profit) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) + 1), 2) as avg_profit_month
           FROM sneaker WHERE sold = 1  AND sell_date >= CONCAT(YEAR(now()), '-01-01')";
           
$sql4 = "SELECT
        ROUND(COUNT(sneakerID) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) + 1), 2) as avg_bought_month
        FROM sneaker WHERE buy_date >= CONCAT(YEAR(now()), '-01-01')";

$sql5 = "SELECT
         ROUND(COUNT(sold) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) + 1), 2) as avg_sold_month
         FROM sneaker WHERE sold = 1 AND sell_date >= CONCAT(YEAR(now()), '-01-01')";

$sql6 = "SELECT ROUND(AVG(DATEDIFF(`sell_date`, `buy_date`)), 0) as 'tts' FROM `sneaker` WHERE sold = 1 AND colorway NOT LIKE '%*%' AND `sell_date` >= CONCAT(YEAR(now()), '-01-01')";

// Funktion zur Ausführung von SQL und Rückgabe von Daten als Array
function fetchData($sql) {
    global $conn;
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Abfrage-Ergebnisse abrufen
$data1 = fetchData($sql);
$data2 = fetchData($sql2);
$data3 = fetchData($sql3);
$data4 = fetchData($sql4);
$data5 = fetchData($sql5);
$data6 = fetchData($sql6);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker-Daten Dashboard</title>
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Chart 1 - Überblick
            var data1 = google.visualization.arrayToDataTable([
                ['Metrik', 'Wert'],
                ['Buying Price', <?php echo $data1['buying_price']; ?>],
                ['Selling Price', <?php echo $data1['selling_price']; ?>],
                ['Fees', <?php echo $data1['fees']; ?>],
                ['Payout', <?php echo $data1['payout']; ?>],
                ['Profit', <?php echo $data1['profit']; ?>]
            ]);
            var options1 = {title: 'Finanzübersicht', pieSliceText: 'percentage', is3D: true};
            var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
            chart1.draw(data1, options1);

            // Chart 2 - Verkaufsstatus
            var data2 = google.visualization.arrayToDataTable([
                ['Status', 'Wert'],
                ['Sold', <?php echo $data2['sold']; ?>],
                ['Buying Price', <?php echo $data2['buying_price']; ?>]
            ]);
            var options2 = {title: 'Verkaufsstatus (Nicht verkauft)', pieSliceText: 'percentage', is3D: true};
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);

            // Chart 3 - Verkauft und ROI/ROS
            var data3 = google.visualization.arrayToDataTable([
                ['Metrik', 'Wert'],
                ['Amount Sold', <?php echo $data3['amount_sold']; ?>],
                ['Selling Price', <?php echo $data3['selling_price']; ?>],
                ['Fees', <?php echo $data3['fees']; ?>],
                ['Payout', <?php echo $data3['payout']; ?>],
                ['Profit', <?php echo $data3['profit']; ?>],
                ['ROI', <?php echo $data3['roi']; ?>],
                ['ROS', <?php echo $data3['ros']; ?>],
                ['Avg Profit per Month', <?php echo $data3['avg_profit_month']; ?>]
            ]);
            var options3 = {title: 'Verkaufte Einheiten & ROI/ROS', pieSliceText: 'percentage', is3D: true};
            var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);

            // Chart 4 - Durchschnittliche monatliche Käufe
            var data4 = google.visualization.arrayToDataTable([
                ['Monatliche Käufe', 'Wert'],
                ['Avg. Monthly Bought', <?php echo $data4['avg_bought_month']; ?>]
            ]);
            var options4 = {title: 'Durchschnittliche monatliche Käufe'};
            var chart4 = new google.visualization.BarChart(document.getElementById('chart_div4'));
            chart4.draw(data4, options4);

            // Chart 5 - Durchschnittliche monatliche Verkäufe
            var data5 = google.visualization.arrayToDataTable([
                ['Monatliche Verkäufe', 'Wert'],
                ['Avg. Monthly Sold', <?php echo $data5['avg_sold_month']; ?>]
            ]);
            var options5 = {title: 'Durchschnittliche monatliche Verkäufe'};
            var chart5 = new google.visualization.BarChart(document.getElementById('chart_div5'));
            chart5.draw(data5, options5);

            // Chart 6 - TTS (Time to Sell)
            var data6 = google.visualization.arrayToDataTable([
                ['TTS (Durchschnittliche Tage)', 'Wert'],
                ['Average TTS', <?php echo $data6['tts']; ?>]
            ]);
            var options6 = {title: 'Durchschnittliche Zeit bis zum Verkauf (TTS)'};
            var chart6 = new google.visualization.BarChart(document.getElementById('chart_div6'));
            chart6.draw(data6, options6);
        }
    </script>
</head>
<body>
    <h1>Sneaker-Daten Dashboard</h1>
    
    <div id="chart_div1" style="width: 900px; height: 500px;"></div>
    <div id="chart_div2" style="width: 900px; height: 500px;"></div>
    <div id="chart_div3" style="width: 900px; height: 500px;"></div>
    <div id="chart_div4" style="width: 900px; height: 500px;"></div>
    <div id="chart_div5" style="width: 900px; height: 500px;"></div>
    <div id="chart_div6" style="width: 900px; height: 500px;"></div>
</body>
</html>

<?php
// Verbindung schließen
$conn->close();
?>
