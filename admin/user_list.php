<?php include('sidebar.php'); ?>
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
                            <h3>User List</h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#inlineForm">
                Add User
            </button>

            <!-- User Table -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="inlineForm" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="addUserForm" action="Back-end/add_user.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" required>
                                            <option value="" disabled selected>Select role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editUserForm" action="Back-end/edit_user.php" method="POST">
                                <input type="hidden" id="editUserId" name="editUserId">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editUsername">Username</label>
                                        <input type="text" class="form-control" id="editUsername" name="editUsername" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editPassword">Password</label>
                                        <input type="password" class="form-control" id="editPassword" name="editPassword" required>
                                    </div>
                                    <div class="form-group">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-control" id="editRole" name="editRole" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
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
            </section>
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

    <!-- JS Scripts -->
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
    $(document).ready(function() {
        loadUserTable();

    // Fungsi untuk memuat tabel user dari database
    function loadUserTable() {
        $.ajax({
            url: 'Back-end/user_data.php',
            method: 'GET',
            success: function(data) {
                const users = JSON.parse(data);
                let rows = '';

                users.forEach(user => {
                    rows += `
                        <tr>
                            <td>${user.username}</td>
                            <td>${user.role}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-id="${user.id}">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                            </td>
                        </tr>`;
                });

                if ($.fn.DataTable.isDataTable('#userTable')) {
                    $('#userTable').DataTable().clear().destroy();
                }

                $('#userTable tbody').html(rows);
                $('#userTable').DataTable({
                    "retrieve": true,
                    "autoWidth": false,
                });
            },
            error: function(xhr, status, error) {
                console.error(`Error loading user data: ${status} - ${error}`);
            }
        });
    }

    // Event delegation for edit buttons
    $(document).on('click', '.btn-warning', function() {
        const userId = $(this).data('id');
        editUser(userId);
    });

    // Fungsi untuk mengedit user
    window.editUser = function(id) {
        $.ajax({
            url: 'Back-end/get_user.php',
            method: 'POST',
            data: { userId: id },
            dataType: 'json',
            success: function(data) {
                if (data.status === 'error') {
                    Swal.fire('Error', data.message, 'error');
                } else {
                    $('#editUserId').val(data.id);
                    $('#editUsername').val(data.username);
                    $('#editPassword').val(data.password);
                    $('#editRole').val(data.role);
                    $('#editUserModal').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.error(`Error fetching user data: ${status} - ${error}`);
            }
        });
    };
    $('#editUserForm').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    $.ajax({
        url: 'Back-end/edit_user.php',
        method: 'POST',
        data: $(this).serialize(), // Serialize the form data
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                }).then(() => {
                    // Close the modal
                    $('#editUserModal').modal('hide'); // Menutup modal

                    // Reload the user table or redirect to user list
                    loadUserTable();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message,
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(`Error: ${status} - ${error}`);
        }
    });
});

    // Fungsi untuk menambahkan user baru
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: 'Back-end/add_user.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#inlineForm').modal('hide');
                    loadUserTable(); // Reload tabel setelah menambahkan user
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
            error: function(xhr, status, error) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'An error occurred. Please try again.',
                    showConfirmButton: false,
                    timer: 1500
                });
                console.error(`Error adding user: ${status} - ${error}`);
            }
        });
    });

    // Fungsi untuk menghapus user
    window.deleteUser = function(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'Back-end/delete_user.php',
                    method: 'POST',
                    data: { userId: id },
                    dataType: 'json', // Mengharapkan respons JSON
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Deleted!', response.message, 'success');
                            loadUserTable(); // Refresh tabel setelah penghapusan
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error!', 'Failed to delete user.', 'error');
                        console.error(`Error deleting user: ${status} - ${error}`);
                    }
                });
            }
        });
    };
});


</script>

</body>
</html>
