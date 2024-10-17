<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('koneksi.php');

    $id = $_POST['id'];
    $part_number = htmlspecialchars($_POST['part_number']);
    $work_instruction_path = htmlspecialchars($_POST['work_instruction_path']);
    $master_parameter_path = htmlspecialchars($_POST['master_parameter_path']);
    $packaging_path = htmlspecialchars($_POST['packaging_path']);

    $work_instruction_file = $_FILES['work_instruction_file'];
    $master_parameter_file = $_FILES['master_parameter_file'];
    $packaging_file = $_FILES['packaging_file'];

    function uploadFile($file, $input_path) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $target_file;
            }
        }
        return $input_path;
    }

    $work_instruction_path = uploadFile($work_instruction_file, $work_instruction_path);
    $master_parameter_path = uploadFile($master_parameter_file, $master_parameter_path);
    $packaging_path = uploadFile($packaging_file, $packaging_path);

    $stmt = $conn->prepare("UPDATE parts SET part_number = ?, work_instruction = ?, master_parameter = ?, packaging = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $part_number, $work_instruction_path, $master_parameter_path, $packaging_path, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Update successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
