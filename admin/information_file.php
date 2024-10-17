<?php include('sidebar.php'); ?>
<?php include('Back-end/information_file.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDD</title>
    <link rel="shortcut icon" href="../assets/compiled/png/LOGO.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/style.css">
    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">
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
                            <h3>Information File</h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Information File</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#inlineForm">
                Add Data
            </button>

            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="partsTable" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Work Instruction</th>
                                        <th>Master Parameter</th>
                                        <th>Packaging</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
        // PHP to display data from the database
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Create URLs from relative paths
                $wi_url = 'file_proxy.php?path=' . urlencode($row["work_instruction"]);
                $param_url = 'file_proxy.php?path=' . urlencode($row["master_parameter"]);
                $pack_url = 'file_proxy.php?path=' . urlencode($row["packaging"]);

                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["part_number"]) . "</td>";
                echo "<td><a href='" . htmlspecialchars($wi_url) . "' target='_blank'>" . htmlspecialchars(basename($row["work_instruction"])) . "</a></td>";
                echo "<td><a href='" . htmlspecialchars($param_url) . "' target='_blank'>" . htmlspecialchars(basename($row["master_parameter"])) . "</a></td>";
                echo "<td><a href='" . htmlspecialchars($pack_url) . "' target='_blank'>" . htmlspecialchars(basename($row["packaging"])) . "</a></td>";
                echo "<td>
                        <a href='#' class='btn btn-warning btn-sm edit-part'
                           data-id='" . htmlspecialchars($row["id"]) . "' 
                           data-part-number='" . htmlspecialchars($row["part_number"]) . "' 
                           data-work-instruction='" . htmlspecialchars($row["work_instruction"]) . "' 
                           data-master-parameter='" . htmlspecialchars($row["master_parameter"]) . "' 
                           data-packaging='" . htmlspecialchars($row["packaging"]) . "' 
                           data-toggle='modal' data-target='#editPartNumberModal'>Edit</a>
                      <a href='#' class='btn btn-danger btn-sm deleteBtn' data-id='" . htmlspecialchars($row["id"]) . "'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Data not found</td></tr>";
        }
        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Modal Add Part Number -->
<div class="modal fade" id="inlineForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Part Number</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPartNumberForm" action="add_part_number.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="partNumberInput">Part Number</label>
                        <input type="text" class="form-control" id="partNumberInput" 
                               name="part_number" placeholder="Input Part Number here" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Work Instruction</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="work_instruction_path" name="work_instruction_path" 
                                       class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="work_instruction_file" name="work_instruction_file" 
                                       class="form-control" onchange="checkInput('work_instruction_path', 'work_instruction_file')">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>

                    <div class="form-group mb-3">
                        <label>Master Parameter</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="master_parameter_path" name="master_parameter_path" 
                                       class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="master_parameter_file" name="master_parameter_file" 
                                       class="form-control" onchange="checkInput('master_parameter_path', 'master_parameter_file')">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>

                    <div class="form-group mb-3">
                        <label>Packaging</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="packaging_path" name="packaging_path" 
                                       class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="packaging_file" name="packaging_file" 
                                       class="form-control" onchange="checkInput('packaging_path', 'packaging_file')">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Part Number</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Part Number -->
<div class="modal fade" id="editPartNumberModal" tabindex="-1" aria-labelledby="editPartNumberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartNumberModalLabel">Edit Part Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editPartNumberForm" method="POST" action="Back-end/update_part.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_part_id" value="">

                    <div class="form-group">
                        <label for="editPartNumberInput" class="form-label">Part Number</label>
                        <input type="text" class="form-control" id="editPartNumberInput" name="part_number" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Work Instruction</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="editWorkInstructionPath" name="work_instruction_path" class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="editWorkInstructionFile" name="work_instruction_file" class="form-control">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Master Parameter</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="editMasterParameterPath" name="master_parameter_path" class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="editMasterParameterFile" name="master_parameter_file" class="form-control">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Packaging</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="editPackagingPath" name="packaging_path" class="form-control" placeholder="Input path here">
                            </div>
                            <div class="col">
                                <input type="file" id="editPackagingFile" name="packaging_file" class="form-control">
                            </div>
                        </div>
                        <small class="form-text text-muted">Choose to input a path or upload a file</small>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

<footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2024 &copy; PT Sanwa Engineering Batam</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a href="#">Arahma Hidayani</a></p>
                </div>
            </div>
        </footer>
    </div>

    <script src="../assets/extensions/jquery/jquery.min.js"></script>
    <script src="../assets/extensions/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/static/js/pages/sweetalert2.js"></script>
    <script src="../assets/static/js/components/dark.js"></script>
<script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/compiled/js/app.js"></script>
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script>
$(document).ready(function () {
    const table = $('#partsTable').DataTable();


 // Add Part Number Form Submission
$('#addPartNumberForm').on('submit', function (e) {
    e.preventDefault(); // Prevent normal form submission

    var formData = new FormData(this);

    $.ajax({
        url: 'add_part_number.php', // PHP file to handle the request
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Tambahkan ini untuk mendapatkan data dalam format JSON
        success: function (response) {
            // Pastikan respons memiliki format yang diharapkan
            if (response.status === 'success') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#inlineForm').modal('hide'); // Menutup modal setelah sukses
                // Reload tabel atau lakukan aksi lain setelah menambahkan data
                location.reload(); // Atau panggil fungsi reload yang spesifik untuk tabel
            } else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'An error occurred. Please try again.',
                showConfirmButton: false,
                timer: 1500
            });
            console.error(`Error adding part number: ${status} - ${error}`);
        }
    });
});


      // Event delegation untuk tombol delete
// Event delegation untuk tombol delete
$(document).on('click', '.deleteBtn', function() {
    var partId = $(this).data('id'); // Ambil ID part dari tombol
    var row = $(this).closest('tr'); // Simpan referensi ke baris tabel

    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user konfirmasi delete, lakukan AJAX request ke delete_part.php
            $.ajax({
                url: 'Back-end/delete_part.php',
                type: 'GET',
                data: { id: partId },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Hapus baris tabel setelah penghapusan berhasil menggunakan DataTables
                        table.row(row).remove().draw(); // Ganti $(this).closest('tr') dengan row
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was a problem deleting the data.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
});
    // Populate Edit Modal with Existing Data
    $(document).on('click', '.edit-part', function () {
        const id = $(this).data('id');
        const partNumber = $(this).data('part-number');
        const workInstruction = $(this).data('work-instruction');
        const masterParameter = $(this).data('master-parameter');
        const packaging = $(this).data('packaging');
        

        $('#editPartNumberModal').find('#editPartNumberInput').val(partNumber);
        $('#editPartNumberModal').find('#editWorkInstructionPath').val(workInstruction);
        $('#editPartNumberModal').find('#editMasterParameterPath').val(masterParameter);
        $('#editPartNumberModal').find('#editPackagingPath').val(packaging);
        $('#editPartNumberModal').find('#edit_part_id').val(id);

        $('#editPartNumberModal').modal('show');
    });

    // Edit Part Number Form Submission
// Edit Part Number Form Submission
$('#editPartNumberForm').on('submit', function (e) {
    e.preventDefault(); // Prevent normal form submission

    var formData = new FormData(this);

    $.ajax({
        url: 'Back-end/update_part.php', // PHP file to handle the request
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Expect JSON response
        success: function (response) {
    console.log(response); // Menambahkan ini untuk melihat respons di konsol browser
    if (response.status === 'success') {
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: response.message,
            showConfirmButton: false,
            timer: 2000
        });
        $('#editPartNumberModal').modal('hide');
        location.reload();
    } else {
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: response.message,
            showConfirmButton: false,
            timer: 2000
        });
    }
},

        error: function () {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'An error occurred. Please try again.',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});

});
</script>



</body>
</html>
