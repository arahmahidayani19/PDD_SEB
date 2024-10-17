<?php include('sidebar.php'); ?>
<?php include('Back-end/koneksi.php'); ?>
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
    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/extensions/choices.js/public/assets/styles/choices.css">
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
                            <h3>Daily Transaction</h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daily Transaction</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Data Button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
                Add Data
            </button>

          
    <div class="filter-container row mb-3">
    <div class="col-md-4">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" class="form-control">
    </div>
    <div class="col-md-4">
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" class="form-control">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button id="filterBtn" class="btn btn-primary mr-2">Filter</button>
        <button id="resetBtn" class="btn btn-secondary">Reset Filter</button>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Daily Transactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="proses_submit.php" method="post">
                    <div class="row">
                        <!-- Repeated fields for 10 items -->
                        <?php for ($i = 0; $i < 10; $i++): ?>
                            <div class="col-md-12 mb-4 entry" id="entry-<?php echo $i; ?>" style="<?php echo $i > 0 ? 'display:none;' : ''; ?>">
                                <h6>Entry <?php echo $i + 1; ?></h6>
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label for="partNumber<?php echo $i; ?>" class="form-label">Part Number</label>
                                        <select id="partNumber<?php echo $i; ?>" name="part_number[]" class="form-control" <?php echo $i === 0 ? 'required' : ''; ?>>
                                            <?php
                                            $sqlpart_number = "SELECT part_number FROM parts";
                                            $resultpart_number = $conn->query($sqlpart_number);
                                            if ($resultpart_number->num_rows > 0) {
                                                while ($rowpart_number = $resultpart_number->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($rowpart_number['part_number']) . '">' . htmlspecialchars($rowpart_number['part_number']) . '</option>';
                                                }
                                            } else {
                                                echo '<option>No PartNumber data found.</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="shift<?php echo $i; ?>" class="form-label">Shift</label>
                                        <select id="shift<?php echo $i; ?>" name="shift[]" class="form-control" <?php echo $i === 0 ? 'required' : ''; ?>>
                                            <option value="1st Shift">1st Shift</option>
                                            <option value="2nd Shift">2nd Shift</option>
                                            <option value="3rd Shift">3rd Shift</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="machineType<?php echo $i; ?>" class="form-label">Line</label>
                                        <select id="machineType<?php echo $i; ?>" name="machineType[]" class="form-control" <?php echo $i === 0 ? 'required' : ''; ?>>
                                            <option value="">Select Line</option>
                                            <?php
                                            // Query to get distinct lines from database
                                            $sqlline = "SELECT DISTINCT line_name FROM lines_machines";
                                            $resultline = $conn->query($sqlline);
                                            if ($resultline->num_rows > 0) {
                                                while ($rowline = $resultline->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($rowline['line_name']) . '">' . htmlspecialchars($rowline['line_name']) . '</option>';
                                                }
                                            } else {
                                                echo '<option>No Line data found.</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="machineNumber<?php echo $i; ?>" class="form-label">Machine</label>
                                        <select id="machineNumber<?php echo $i; ?>" name="machineNumber[]" class="form-control">
                                            <option>Select a machine</option>
                                            <?php
                                            // Query to get distinct machines from database
                                            $sqlline = "SELECT DISTINCT machine_name FROM lines_machines";
                                            $resultline = $conn->query($sqlline);
                                            if ($resultline->num_rows > 0) {
                                                while ($rowline = $resultline->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($rowline['machine_name']) . '">' . htmlspecialchars($rowline['machine_name']) . '</option>';
                                                }
                                            } else {
                                                echo '<option>No Machine data found.</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="machineStatus<?php echo $i; ?>" class="form-label">Machine Status</label>
                                        <input type="text" id="machineStatus<?php echo $i; ?>" name="machineStatus[]" class="form-control" placeholder="Machine status" <?php echo $i === 0 ? 'required' : ''; ?>>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="transactionDate<?php echo $i; ?>" class="form-label">Date</label>
                                        <input type="date" id="transactionDate<?php echo $i; ?>" name="transactionDate[]" class="form-control" <?php echo $i === 0 ? 'required' : ''; ?>>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addEntryBtn" class="btn btn-primary">Add Entry</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="proses_edit.php" method="post">
                    <input type="hidden" name="id" id="editId">
                    <!-- Repeat input fields similar to your main modal -->
                    <div class="form-group">
                        <label for="editPartNumber">Part Number</label>
                        <select id="editPartNumber" name="part_number" class="form-control" required>
                            <!-- Populate options similarly -->
                        </select>
                    </div>
                    <div class="modal-footer">
                    <!-- Add other fields as needed -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="table-responsive mt-4">
        <table id="transactionsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Line</th>
                    <th>Machine</th>
                    <th>Tonnage</th>
                    <th>Part Number</th>
                    <th>Shift</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // Gabungkan tabel form_data dengan lines_machines berdasarkan machineNumber
    $sql = "SELECT form_data.*, lines_machines.tonnage 
        FROM form_data 
        LEFT JOIN lines_machines 
        ON form_data.machineNumber COLLATE utf8mb4_unicode_ci = lines_machines.machine_name COLLATE utf8mb4_unicode_ci 
        ORDER BY form_data.transaction_date DESC";

    
    $result = $conn->query($sql);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['machineType']) . "</td>
                    <td>" . htmlspecialchars($row['machineNumber']) . "</td>
                    <td>" . htmlspecialchars($row['tonnage']) . "</td> <!-- Nilai ton dari tabel lines_machines -->
                    <td>" . htmlspecialchars($row['part_number']) . "</td>
                    <td>" . htmlspecialchars($row['shift']) . "</td>
                    <td>" . htmlspecialchars($row['transaction_date']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
    ?>
</tbody>


        </table>
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

        document.addEventListener('DOMContentLoaded', function() {
            var table = $('#transactionsTable').DataTable();

            document.getElementById('filterBtn').addEventListener('click', function() {
                var startDate = new Date(document.getElementById('startDate').value);
                var endDate = new Date(document.getElementById('endDate').value);

                if (startDate > endDate) {
                    alert('Start date must be less than or equal to end date.');
                    return;
                }

                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var date = new Date(data[5]); // Kolom tanggal (index 5)
                    if (
                        (startDate === "" && endDate === "") ||
                        (startDate === "" && date <= endDate) ||
                        (endDate === "" && date >= startDate) ||
                        (date >= startDate && date <= endDate)
                    ) {
                        return true;
                    }
                    return false;
                });

                table.draw();
            });

            document.getElementById('resetBtn').addEventListener('click', function() {
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
                table.search('').draw(); 
            });

        });

            // Add Entry Button functionality
            document.getElementById('addEntryBtn').addEventListener('click', function() {
                var entries = document.querySelectorAll('.entry');
                for (var i = 0; i < entries.length; i++) {
                    if (entries[i].style.display === 'none') {
                        entries[i].style.display = 'block';
                        break;
                    }
                }
            });

            // Initialize DataTable
            $('#transactionsTable').DataTable();

            document.querySelectorAll('.edit-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    // Populate the edit modal with data (using AJAX if needed)
                    document.getElementById('editId').value = id;
                    // Add other fields as needed
                    $('#editModal').modal('show'); // Show the edit modal
                });
            });
        
            // Handle Delete button click
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = this.closest('tr'); // Get the row to hide
                    row.style.display = 'none'; // Hide the row
                    // Optionally store the id for future use if needed
                });
            });
        

    </script>
</div>
</body>
</html>

<?php
$conn->close();
?>
