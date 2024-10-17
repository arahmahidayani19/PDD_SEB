<?php
session_start();
include 'koneksi.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID and new data from the form
    $userId = $_POST['editUserId'];
    $username = $_POST['editUsername'];
    $password = $_POST['editPassword'];
    $role = $_POST['editRole'];

    $response = [];

    // Check if the new username is unique
    $sql = "SELECT id FROM users WHERE username=? AND id <> ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $username, $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Username already exists
            $response['status'] = 'error';
            $response['message'] = 'Error: Username already exists.';
            echo json_encode($response);
            $stmt->close();
            $conn->close();
            exit();
        }

        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
        echo json_encode($response);
        $conn->close();
        exit();
    }

    // Prepare the SQL statement to update the user
    $sql = "UPDATE users SET username=?, password=?, role=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the statement
        $stmt->bind_param("sssi", $username, $password, $role, $userId);

        // Execute the statement
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'User updated successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }

    // Close the connection
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
}
?>
