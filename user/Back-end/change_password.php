<?php

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Return JSON response for unauthorized access
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

// Include database connection
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password_baru'];
    $confirm_password = $_POST['konfirmasi_password'];

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match!']);
        exit();
    }

    // Prepare the SQL statement
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $new_password, $_SESSION['username']);

        // Execute the statement
        if ($stmt->execute()) {
            // Password change successful
            echo json_encode(['status' => 'success', 'message' => 'Password changed successfully!']);
        } else {
            // SQL execution error
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // SQL preparation error
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement.']);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
