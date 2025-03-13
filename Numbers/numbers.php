<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" sizes="32x32" href="/Sneaker_Red.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Numbers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        background-color: #f8f9fa;
    }

    .numbers-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem;
    }

    .stat-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-label {
        font-weight: 500;
        color: #6c757d;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .profit-positive {
        color: #198754;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        padding: 0.75rem 1rem 0 1rem;
        color: #212529;
    }

    .navbar-nav .nav-link {
        color: #00001a;
        transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        border-bottom: 2px solid transparent;
        padding-bottom: 5px;
    }

    .navbar-nav .nav-link:hover {
        color: #d14124 !important;
        border-bottom: 2px solid #d14124 !important;
    }

    .info-note {
        font-size: 0.8rem;
        color: #6c757d;
        font-style: italic;
        padding: 0 1rem;
    }

    .container-main {
        max-width: 1000px;
        margin: 0 auto;
    }

    .divider-heading {
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <img src="logo.png" width="100" height="60" class="me-5 d-inline-block align-top" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link text-dark" href="../index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/stores/stores.html">Stores</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/buy/buy_page.php">Buy</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/sell/sell_landing_page.php">Sell</a></li>
                    <li class="nav-item"><a class="nav-link border-bottom" href="/numbers/numbers.php">Numbers</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/overview/overview.php">Overview</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/edit/edit_landing_page.php">Edit</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/tools/tools.php">Tools</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container container-main">
        <h3 class="mb-4 divider-heading">Business Performance</h3>

        <div class="row">
            <!-- Summary Card -->
            <div class="col-md-6 mb-4">
                <div class="numbers-card">
                    <div class="card-header">
                        <h5 class="mb-0">Overview</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        include '../db_config.php';
                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die('<div class="alert alert-danger m-3">Connection failed: ' . $conn->connect_error . '</div>');
                        }

                        $sql = "SELECT 
                                FORMAT(SUM(buying_price),2, 'de_DE')as buying_price,
                                FORMAT(sum(selling_price),2, 'de_DE') as selling_price,
                                FORMAT(sum(shipping_fee) + sum(transaction_fee),2, 'de_DE') as fees,
                                FORMAT(sum(payout),2, 'de_DE') as payout,
                                FORMAT(sum(profit),2, 'de_DE') as profit,
                                max(invoiceNumber) as invoiceNumber,
                                count(sneakerID) as amount
                                FROM sneaker";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Current Invoice</div>';
                                echo '<div class="stat-value">#' . $row["invoiceNumber"] . '</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Invest <small class="text-secondary">(since 20.02.2023)</small></div>';
                                echo '<div class="stat-value">' . $row["buying_price"] . ' €</div>';
                                echo '</div>';

                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Purchases</div>';
                                echo '<div class="stat-value">' . $row["amount"] . ' pairs</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Payout <small class="text-secondary">(since 20.02.2023)</small></div>';
                                echo '<div class="stat-value profit-positive">' . $row["payout"] . ' €</div>';
                                echo '</div>';
                            }
                        }

                        $sql2 = "SELECT count(sold) as sold,
                               FORMAT(sum(buying_price),2, 'de_DE') as buying_price
                               FROM sneaker WHERE sold = 0";

                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Current Stock Value</div>';
                                echo '<div class="stat-value">' . $row["buying_price"] . ' €</div>';
                                echo '</div>';

                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Current Inventory</div>';
                                echo '<div class="stat-value">' . $row["sold"] . ' pairs</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Sales Performance Card -->
            <div class="col-md-6 mb-4">
                <div class="numbers-card">
                    <div class="card-header">
                        <h5 class="mb-0">Sales Performance YTD</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $sql3 = "SELECT
                               count(sneakerID) as amount_sold,
                               FORMAT(sum(selling_price),2, 'de_DE') as selling_price,
                               FORMAT(sum(shipping_fee) + sum(transaction_fee),2, 'de_DE') as fees,
                               FORMAT(sum(payout),2, 'de_DE') as payout,
                               FORMAT(sum(profit),2, 'de_DE') as profit,
                               FORMAT(sum(buying_price),2, 'de_DE') as buying_price,
                               FORMAT(ROUND( ((sum(profit) / sum(buying_price)) * 100), 2),2, 'de_DE') as roi,
                               FORMAT(ROUND( ((sum(profit) / sum(payout)) * 100), 2),2, 'de_DE') as ros,
                               FORMAT(ROUND(sum(profit) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) +1), 2),2, 'de_DE') as avg_profit_month
                               FROM sneaker WHERE sold = 1 AND sell_date >= CONCAT(YEAR(now()), '-01-01')";

                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0) {
                            while ($row = $result3->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Sneakers Sold</div>';
                                echo '<div class="stat-value">' . $row["amount_sold"] . ' pairs</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Purchase Cost</div>';
                                echo '<div class="stat-value">' . $row["buying_price"] . ' €</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Selling Price</div>';
                                echo '<div class="stat-value">' . $row["selling_price"] . ' €</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Fees</div>';
                                echo '<div class="stat-value">' . $row["fees"] . ' €</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Payout</div>';
                                echo '<div class="stat-value">' . $row["payout"] . ' €</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Total Profit</div>';
                                echo '<div class="stat-value profit-positive">' . $row["profit"] . ' €</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Key Performance Indicators -->
            <div class="col-md-6 mb-4">
                <div class="numbers-card">
                    <div class="card-header">
                        <h5 class="mb-0">KPIs</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0) {
                            while ($row = $result3->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Return on Investment (ROI)</div>';
                                echo '<div class="stat-value profit-positive">' . $row["roi"] . ' %</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Return on Sales (ROS)</div>';
                                echo '<div class="stat-value profit-positive">' . $row["ros"] . ' %</div>';
                                echo '</div>';
                                
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Avg. Monthly Profit</div>';
                                echo '<div class="stat-value profit-positive">' . $row["avg_profit_month"] . ' €</div>';
                                echo '</div>';
                            }
                        }

                        echo '<div class="info-note mb-3 mt-2">* Selling price can differ up to 5% and fees can differ up to 10%</div>';
                        ?>
                    </div>
                </div>
            </div>

            <!-- Monthly Statistics -->
            <div class="col-md-6 mb-4">
                <div class="numbers-card">
                    <div class="card-header">
                        <h5 class="mb-0">Monthly Statistics</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $sql4 = "SELECT
                            FORMAT(ROUND(count(sneakerID) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) +1),2), 2, 'de_DE') as avg_bought_month
                            FROM sneaker WHERE buy_date >= CONCAT(YEAR(now()), '-01-01')";

                        $result4 = $conn->query($sql4);
                        if ($result4->num_rows > 0) {
                            while ($row = $result4->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Avg. Purchased Per Month</div>';
                                echo '<div class="stat-value">' . $row["avg_bought_month"] . ' pairs</div>';
                                echo '</div>';
                            }
                        }

                        $sql5 = "SELECT
                             FORMAT(ROUND(count(sold) / (TIMESTAMPDIFF(MONTH, CONCAT(YEAR(now()), '-01-01'), now()) +1),2), 2, 'de_DE') as avg_sold_month
                             FROM sneaker WHERE sold = 1 AND sell_date >= CONCAT(YEAR(now()), '-01-01')";

                        $result5 = $conn->query($sql5);
                        if ($result5->num_rows > 0) {
                            while ($row = $result5->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Avg. Sold Per Month</div>';
                                echo '<div class="stat-value">' . $row["avg_sold_month"] . ' pairs</div>';
                                echo '</div>';
                            }
                        }

                        $sql6 = "SELECT FORMAT(ROUND(AVG(DATEDIFF(`sell_date`, `buy_date`)),0),0, 'de_DE') as 'tts' FROM `sneaker` WHERE sold = 1 AND colorway NOT LIKE '%*%' AND `sell_date` >= CONCAT(YEAR(now()), '-01-01')";
                        $result6 = $conn->query($sql6);
                        if ($result6->num_rows > 0) {
                            while ($row = $result6->fetch_assoc()) {
                                echo '<div class="stat-item d-flex justify-content-between align-items-center">';
                                echo '<div class="stat-label">Avg. Time to Sell (TTS)</div>';
                                echo '<div class="stat-value">' . $row["tts"] . ' days</div>';
                                echo '</div>';
                                
                                echo '<div class="info-note mb-3 mt-2">* Deposit sneakers excluded from TTS calculation</div>';
                            }
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>