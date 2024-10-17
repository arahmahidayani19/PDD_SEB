<?php
include 'koneksi.php'; // Pastikan koneksi.php sudah di-include dengan benar

session_start();

header('Content-Type: application/json'); // Set header untuk JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pn'], $_POST['pn_name'])) {
    $pn = mysqli_real_escape_string($conn, $_POST['pn']);
    $pn_name = mysqli_real_escape_string($conn, $_POST['pn_name']);

    $sql = "INSERT INTO pn (pn, pn_name) VALUES ('$pn', '$pn_name')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response = array(
            'success' => true,
            'message' => 'Part number added successfully!'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error adding part number: ' . mysqli_error($conn)
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request. Please provide all required fields.'
    );
}

echo json_encode($response); // Pastikan tidak ada output sebelum ini
?>
