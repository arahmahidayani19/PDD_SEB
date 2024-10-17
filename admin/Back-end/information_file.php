<?php

$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

// Koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = ""; // Ganti dengan password database Anda jika ada
$dbname = "pdd";

// Buat koneksi ke database
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan parameter pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
// Query untuk mengambil data dari tabel 'parts'
$sql = "SELECT * FROM parts WHERE part_number LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = "%$search%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>