<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" sizes="32x32" href="/Sneaker_Red.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Tools</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/calcFees.js"></script>
    <script src="../js/copyText.js"></script>
    <style>
        body {
            background-color: #ffffff;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            color: #212529;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .btn-danger {
            background-color: #d03f44;
            border-color: #d03f44;
        }

        .btn-danger:hover {
            background-color: #e91640;
            border-color: #e91640;
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
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
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
                    <li class="nav-item"><a class="nav-link text-dark" href="/numbers/numbers.php">Numbers</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/overview/overview.php">Overview</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/edit/edit_landing_page.php">Edit</a></li>
                    <li class="nav-item"><a class="nav-link border-bottom" href="/tools/tools.php">Tools</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="text-center mb-4" style="font-weight: 300;">Tools</h1>

        <div class="row">
            <!-- Fee Calculator Card -->
            <div class="col-lg-5 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0" style="font-weight: 400;">Fee Calculator</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="calcFeesInput" class="form-label">Enter Net Price:</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="calcFeesInput" placeholder="Net-Price" step="0.01" required>
                                <button class="btn btn-primary" type="button" onclick="calcFees()">Calculate</button>
                            </div>
                            <small class="text-muted">Calculates gross price including payment processing fees.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copy Templates Card -->
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0" style="font-weight: 400;">Message Templates</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Quick copy templates for common messages:</p>
                        
                        <!-- Shipping Address Template -->
                        <div class="mb-3">
                            <div class="card bg-light mb-2">
                                <div class="card-body py-2">
                                    <pre class="mb-0 text-muted">Versandadresse ist:
Maximilian Bronkhorst
Afrikanische Straße 23
13351 Berlin</pre>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm" type="button" onclick="copyShippingAdress()">
                                Copy Shipping Address
                            </button>
                        </div>
                        
                        <!-- Mark as Paid Template -->
                        <div class="mb-3">
                            <div class="card bg-light mb-2">
                                <div class="card-body py-2">
                                    <pre class="mb-0 text-muted">Ist bezahlt, kannst du dann als verkauft markieren</pre>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm" type="button" onclick="copyMarkAsPayed()">
                                Copy "Mark as Paid"
                            </button>
                        </div>
                        
                        <!-- Review Template -->
                        <div class="mb-3">
                            <div class="card bg-light mb-2">
                                <div class="card-body py-2">
                                    <pre class="mb-0 text-muted">Hinterlass mir gerne noch eine Bewertung und folg mir für weitere ähnliche Angebote :)</pre>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm" type="button" onclick="copyReview()">
                                Copy "Review + Follow"
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Removed Quick Links Card -->
        </div>
    </div>

</body>

</html>