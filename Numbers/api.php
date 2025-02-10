<?php
$servername = "servername";
$username = "username";
$password = "password";
$dbname = "database";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker Insights</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            fetchChartData('profitability', drawProfitabilityChart);
            fetchChartData('roi_analysis', drawROIChart);
            fetchChartData('price_vs_sell_probability', drawPriceVsSellChart);
            fetchChartData('best_roi', drawBestROIChart);
            fetchChartData('profit_margin_vs_buying_price', drawProfitMarginChart);
        }

        function fetchChartData(query, callback) {
            fetch(`api.php?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log(`DEBUG (${query}):`, data);
                    callback(data);
                })
                .catch(error => console.error(`Fehler beim Laden von ${query}:`, error));
        }

        function drawProfitabilityChart(data) {
            let dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Marke');
            dataTable.addColumn('string', 'Modell');
            dataTable.addColumn('number', 'Profit');

            data.forEach(row => {
                dataTable.addRow([row.brand, row.modell, parseFloat(row.profit)]);
            });

            let options = { title: 'Profitabilität pro Marke & Modell' };
            let chart = new google.visualization.ColumnChart(document.getElementById('chart_profitability'));
            chart.draw(dataTable, options);
        }

        function drawROIChart(data) {
            let dataTable = new google.visualization.DataTable();
            dataTable.addColumn('number', 'Einkaufspreis');
            dataTable.addColumn('number', 'Profit');

            data.forEach(row => {
                dataTable.addRow([parseFloat(row.buying_price), parseFloat(row.profit)]);
            });

            let options = { title: 'Gewinn vs. Kaufpreis (ROI-Analyse)' };
            let chart = new google.visualization.ScatterChart(document.getElementById('chart_roi_analysis'));
            chart.draw(dataTable, options);
        }

        function drawPriceVsSellChart(data) {
            let dataTable = new google.visualization.DataTable();
            dataTable.addColumn('number', 'Einkaufspreis');
            dataTable.addColumn('number', 'Verkaufspreis');
            dataTable.addColumn('number', 'Profit');

            data.forEach(row => {
                dataTable.addRow([parseFloat(row.buying_price), parseFloat(row.selling_price), parseFloat(row.profit)]);
            });

            let options = { title: 'Verhältnis von Einkaufspreis zu Verkaufswahrscheinlichkeit & Profitabilität' };
            let chart = new google.visualization.ScatterChart(document.getElementById('chart_price_vs_sell'));
            chart.draw(dataTable, options);
        }

        function drawBestROIChart(data) {
            let dataTable = new google.visualization.DataTable();
            dataTable.addColumn('number', 'Einkaufspreis');
            dataTable.addColumn('number', 'ROI (%)');

            data.forEach(row => {
                dataTable.addRow([parseFloat(row.buying_price), parseFloat(row.roi_percentage)]);
            });

            let options = { title: 'Bestes Preis-Leistungs-Verhältnis beim Einkauf' };
            let chart = new google.visualization.ScatterChart(document.getElementById('chart_best_roi'));
            chart.draw(dataTable, options);
        }

        function drawProfitMarginChart(data) {
            let dataTable = new google.visualization.DataTable();
            dataTable.addColumn('number', 'Einkaufspreis');
            dataTable.addColumn('number', 'Profit');

            data.forEach(row => {
                dataTable.addRow([parseFloat(row.buying_price), parseFloat(row.profit)]);
            });

            let options = { title: 'Profit-Margen im Verhältnis zum Einkaufspreis' };
            let chart = new google.visualization.ScatterChart(document.getElementById('chart_profit_margin'));
            chart.draw(dataTable, options);
        }
    </script>
</head>
<body>
    <h1>Sneaker Verkaufs-Insights</h1>
    <div id="chart_profitability" style="width: 100%; height: 400px;"></div>
    <div id="chart_roi_analysis" style="width: 100%; height: 400px;"></div>
    <div id="chart_price_vs_sell" style="width: 100%; height: 400px;"></div>
    <div id="chart_best_roi" style="width: 100%; height: 400px;"></div>
    <div id="chart_profit_margin" style="width: 100%; height: 400px;"></div>
</body>
</html>
