<?php
session_start(); // Pastikan sesi dimulai

// Cek apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil nama pengguna dari sesi
} else {
    $username = 'Guest'; // Nama default jika belum login
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDD</title>
    <link rel="shortcut icon" href="../assets/compiled/png/LOGO.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../assets/compiled/css/style.css">
    <link rel="stylesheet" href="../assets/compiled/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">
</head>

<body>
    <script src="../assets/static/js/initTheme.js"></script>
    <div class="topbar transition">
    <div class="bars"></div>
    <div class="menu">
        <ul>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/compiled/jpg/profile.png" alt="">
                    Hi,<span id="username"><?php echo htmlspecialchars($username); ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>

    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="#"><img src="../assets/compiled/png/sanwa.png" alt="Logo"></a>
                            <h5>Production Display</h5>
                        </div>
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item active">
                            <a href="dashboard.php" class="sidebar-link">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="daily_tr.php" class="sidebar-link">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Daily Transaction</span>
                            </a>
                        </li>


                        <li class="sidebar-title">Profile</li>

                        <li class="sidebar-item">
                            <a href="change_password.php" class="sidebar-link">
                                <i class="fas fa-key"></i>
                                <span>Change Password</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                        <a href="#" class="sidebar-link" onclick="confirmLogout()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Log-out</span>
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to logout.php
                    window.location.href = '../login/logout.php';
                }
            });
        }
    </script>
    <script src="../assets/static/js/components/dark.js"></script>
    <script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/compiled/js/app.js"></script>
    <script src="../assets/compiled/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/static/js/pages/dashboard.js"></script>
    <script src="../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/static/js/pages/sweetalert2.js"></script>
</body>

</html>
