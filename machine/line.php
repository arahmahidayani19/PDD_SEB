<?php
// Include the backend logic to retrieve data
include('Back-end/line.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PDD</title>
    <link rel="shortcut icon" href="../assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../assets/compiled/css/style.css">
    <link rel="stylesheet" href="../assets/compiled/css/dashboard.css">
</head>

<body>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="container">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mt-3">Production Line - <?php echo $line; ?></h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Line</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn" id="btn-back">
                <a href="javascript:history.back()" class="btn btn-primary mt-3 btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="row">
                <?php foreach ($machines as $machine_name): ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="production-line">
                            <a href="machine.php?line=<?php echo urlencode($_GET['line']); ?>&machine=<?php echo urlencode($machine_name); ?>">
                                Machine <?php echo htmlspecialchars($machine_name); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div> <!-- Closing the container div -->

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2024 &copy; PT Sanwa Engineering Batam</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="#">Arahma Hidayani</a></p>
                </div>
            </div>
        </footer>
    </div> <!-- Closing the main div -->

    <script src="../assets/static/js/components/dark.js"></script>
    <script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/compiled/js/app.js"></script>
    <script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/static/js/pages/dashboard.js"></script>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            console.log('Toggle clicked');
            document.getElementById('sidebar').classList.toggle('toggled');
            document.getElementById('mainContent').classList.toggle('toggled');
        });

        // Update date and time
        function updateTime() {
            const now = new Date();
            const dateTimeString = now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
            document.getElementById('date-time').textContent = dateTimeString;
        }

        setInterval(updateTime, 1000); // Update every second
        updateTime(); // Initial call to set the date and time immediately
    </script>
</body>
</html>
