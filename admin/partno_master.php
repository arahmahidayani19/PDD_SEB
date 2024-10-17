<?php include('sidebar.php'); ?>
<?php include('Back-end/partno_master.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Part Number Master</title>
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
                            <h3>Part Number Master</h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Part Number Master</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPNModal">
                Add Data
            </button>

            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="partNumber" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT id, pn, pn_name FROM pn";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['pn']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['pn_name']) . '</td>';
                                            echo '<td>';
                                            echo '<div class="d-flex gap-2">';
                                            echo '<button type="button" class="btn btn-sm btn-warning" onclick="editPN(' . $row['id'] . ', \'' . htmlspecialchars($row['pn']) . '\', \'' . htmlspecialchars($row['pn_name']) . '\')">Edit</button>';
                                            echo '<button type="button" class="btn btn-sm btn-danger ml-2" onclick="deletePN(' . $row['id'] . ')">Delete</button>';
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No part numbers found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Add Part Number Modal -->
        <div class="modal fade" id="addPNModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Part Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addPNForm" action="Back-end/add_pn.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="pn">Part Number</label>
                                    <input type="text" class="form-control" id="pn" name="pn" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pn_name">Part Name</label>
                                    <input type="text" class="form-control" id="pn_name" name="pn_name" required>
                                </div>
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

        <!-- Edit Part Number Modal -->
        <div class="modal fade" id="editPNModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Part Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editPNForm" method="POST" action="Back-end/edit_pn.php">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="editPNId">Part Number ID</label>
                                    <input type="text" class="form-control" id="editPNId" name="editPNId" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="editPNCode">Part Number</label>
                                    <input type="text" class="form-control" id="editPNCode" name="editPNCode" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="editPNName">Part Name</label>
                                    <input type="text" class="form-control" id="editPNName" name="editPNName" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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
        // DataTable initialization
        $(document).ready(function () {
            $('#partNumber').DataTable({
                responsive: true,
                columnDefs: [
                    { targets: [2], orderable: false } // Disable sorting on the 'Action' column
                ],
                lengthMenu: [10, 25, 50], // Adjust to your preference
                pageLength: 10,           // Default page length
            });
        });

     // Function to handle deletion of part numbers
function deletePN(id) {
    // Show confirmation dialog with SweetAlert before proceeding with delete
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, proceed with AJAX request to delete the part number
            $.ajax({
                url: 'Back-end/delete_pn.php', // PHP script to handle deletion
                type: 'POST',
                data: { deletePNId: id }, // Send the part number ID to delete
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            timer: 1500,  // Automatically close after 1.5 seconds
                            showConfirmButton: false
                        }).then(() => {
                            // Reload the page after deletion
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an issue with the request. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}
  // Function to handle edit of part numbers (example of how to use SweetAlert)
  function editPN(id, pn, pn_name) {
        // Populate modal fields with current data
        $('#editPNId').val(id);
        $('#editPNCode').val(pn);
        $('#editPNName').val(pn_name);

        // Show the modal to the user
        $('#editPNModal').modal('show');
    }
    
// Function to handle adding part numbers
$('#addPNForm').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    $.ajax({
        url: 'Back-end/add_pn.php', 
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1500,  // Automatically close after 1.5 seconds
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an issue with the request. Please try again later.',
                confirmButtonText: 'OK'
            });
        }
    });
});

// Function to handle edit form submission (AJAX example)
$('#editPNForm').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    $.ajax({
        url: 'Back-end/edit_pn.php', // URL to edit part number
        type: 'POST',
        data: $(this).serialize(), // Serialize form data
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1500,  // Automatically close after 1.5 seconds
                    showConfirmButton: false
                }).then(() => {
                    location.reload(); // Reload the page after successful update
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an issue with the request. Please try again later.',
                confirmButtonText: 'OK'
            });
        }
    });
});

        </script>

</body>
</html>
