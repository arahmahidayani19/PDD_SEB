<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDD - Login</title>
    <link rel="stylesheet" href="../assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../assets/compiled/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/compiled/css/login.css">
    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <div class="icon-container">
            <img src="../assets/compiled/png/sanwa.png" alt="LOGO Logo">
        </div>
        <h3>Production Display</h3>

        <form id="loginForm" method="post" action="proses_login.php">
            <div class="input-wrapper">
                <i class="fas fa-user-alt"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="toggle-password">
                <input type="checkbox" id="toggleCheckbox" onclick="togglePassword()">
                <label for="toggleCheckbox">Show Password</label>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>

    <script src="../assets/compiled/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/static/js/pages/sweetalert2.js"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleCheckbox = document.getElementById('toggleCheckbox');

            if (toggleCheckbox.checked) {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        }

        // Handle the login form submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            fetch(this.action, {
                method: this.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Check the response from your login process
                if (data.success) {
                    Swal.fire({
                        title: 'Login Successful',
                        text: 'Welcome ' + data.role,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = data.redirect_url; // Redirect based on role or successful login
                    });
                } else {
                    Swal.fire({
                        title: 'Login Failed',
                        text: data.message || 'Invalid username or password.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
</body>
</html>
