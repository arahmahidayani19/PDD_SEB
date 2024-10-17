<?php
session_start();

$conn = new mysqli("localhost", "root", "", "pdd");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil input dari form
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$response = array(); // Prepare the response array

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if ($password == $user['password']) { // Ganti dengan password_verify() jika password terenkripsi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Success response
        $response['success'] = true;
        $response['role'] = $user['role']; // Provide the user role
        $response['redirect_url'] = ($user['role'] == 'admin') ? '../admin/dashboard.php' : '../user/dashboard.php'; // Define redirect URL
    } else {
        // Password salah
        $response['success'] = false;
        $response['message'] = 'Invalid username or password.';
    }
} else {
    // Username tidak ditemukan
    $response['success'] = false;
    $response['message'] = 'Invalid username or password.';
}

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();
?>
