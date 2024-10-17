<?php
include 'koneksi.php'; // Make sure koneksi.php is included correctly

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editPNId'], $_POST['editPNCode'], $_POST['editPNName'])) {
    $editPNId = mysqli_real_escape_string($conn, $_POST['editPNId']); // Escaping to prevent SQL injection
    $editPNCode = mysqli_real_escape_string($conn, $_POST['editPNCode']);
    $editPNName = mysqli_real_escape_string($conn, $_POST['editPNName']);

    $sql = "UPDATE pn SET pn = '$editPNCode', pn_name = '$editPNName' WHERE id = $editPNId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Send a success response in JSON format
        $response = array(
            'success' => true,
            'message' => 'Part number updated successfully!'
        );
        echo json_encode($response);
    } else {
        // Send an error response in JSON format
        $response = array(
            'success' => false,
            'message' => 'Error updating part number: ' . mysqli_error($conn)
        );
        echo json_encode($response);
    }
} else {
    // Send a response for invalid request
    $response = array(
        'success' => false,
        'message' => 'Invalid request. Please provide all required fields.'
    );
    echo json_encode($response);
}
?>
