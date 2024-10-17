<?php
// Include the backend logic to retrieve data
include('Back-end/dashbord.php');
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
                        <h3 class="mt-3">Production Display</h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Production Display</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
<div class="page-content"> 
    <section class="row">
        <?php
        // Display lines from the backend
        if (!empty($lines)) {
            foreach ($lines as $line): ?>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="production-line">
                        <a href="line.php?line=<?php echo urlencode($line); ?>">
                            <i class="fas fa-industry"></i> <!-- Font Awesome Icon -->
                            Line <?php echo htmlspecialchars($line); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach;
        } else {
            // Display a message if no lines are found
            echo '<div class="col-12"><p>No production lines found.</p></div>';
        }
        ?>
          </div>
      
    </section>
</div>

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
</div>
<script src="../assets/static/js/components/dark.js"></script>
<script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/compiled/js/app.js"></script>
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../assets/static/js/pages/dashboard.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTime() {
            const now = new Date();
            const dateTimeString = now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
            document.getElementById('date-time').textContent = dateTimeString;
        }

        function updateGreeting() {
            const now = new Date();
            const hours = now.getHours();
            let greeting = '';

            if (hours < 12) {
                greeting = 'Good morning';
            } else if (hours < 18) {
                greeting = 'Good afternoon';
            } else {
                greeting = 'Good evening';
            }

            document.getElementById('greeting').textContent = `${greeting}, <?php echo htmlspecialchars($username); ?>!`;
        }

        setInterval(updateTime, 1000); // Update every second
        updateTime(); // Initial call to set the date and time immediately

        updateGreeting(); // Set greeting on page load
        setInterval(updateGreeting, 60000); // Update greeting every minute
    });
</script>