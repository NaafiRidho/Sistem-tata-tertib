<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Si Tertib - Data Dosen">
    <meta name="keywords" content="Data Dosen, Si Tertib">
    <title>List Tata Tertib</title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            width: 240px;
            background-color: #002a8a;
            position: fixed;
            height: 100%;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            color: white;
            margin: 20px 0;
            font-size: 2rem;
            font-family: 'Fugaz One', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 4);
        }

        .menu {
            flex-grow: 1;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 15px;
            text-decoration: none;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background-color: #0056b3;
            border-left: 5px solid #ffcc00;
        }

        .logout a {
            display: block;
            text-align: center;
            color: white;
            padding: 10px;
            font-size: 1rem;
            text-decoration: none;
            background-color: #d9534f;
            transition: background-color 0.3s;
        }

        .logout a:hover {
            background-color: #c9302c;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .table-container {
            margin: 20px auto;
            padding: 20px;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }


        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .search-bar input {
            width: 250px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: center;
            height: 70%;
        }

        th {
            background-color: #f2f2f2;
        }

        .sidebar img {
            display: block;
            margin: 20px auto;
            border-radius: 30%;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .entries-info {
            color: #666;
        }

        .pagination {
            margin: 0;
        }

        .dataTables_paginate {
            float: right !important;
        }

        .dataTables_filter {
            float: right !important;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="menu">
            <img src="logo.png" style="width: 120px; height: 120px;">
            <h2>Si Tertib</h2>
            <a href="dashboardAdmin.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="listTataTertibAdmin.php" class="active"><i class="bi bi-list-check"></i> List Tata Tertib</a>
            <a href="dataMhs.php"><i class="bi bi-person"></i> Data Mahasiswa</a>
            <a href="dataDosen.php"><i class="bi bi-person-badge"></i> Data Dosen</a>
            <a href="#pelanggaranMahasiswa"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>List Tata Tertib</h1>
        <div class="table-container">
            <div class="search-bar">
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAddRule">+ Peraturan Baru</button>

            </div>
            <table id="example" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggaran</th>
                        <th>Tingkat</th>
                        <th>Sanksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";

                    $options = array("Scrollable" => SQLSRV_CURSOR_STATIC);
                    $query = "SELECT pelanggaran.pelanggaran, tingkat.tingkat, tingkat.sanksi
            FROM pelanggaran
            JOIN tingkat ON pelanggaran.tingkat_id = tingkat.tingkat_id";

                    // Execute the query
                    $result = sqlsrv_query($conn, $query, array(), $options);

                    // Check if the query was successful
                    if ($result === false) {
                        die(print_r(sqlsrv_errors(), true));  // Print SQL errors if the query failed
                    }

                    if (sqlsrv_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['pelanggaran'] ?></td>
                                <td><?php echo $row['tingkat'] ?></td>
                                <td><?php echo $row['sanksi'] ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-pelanggaran="<?php echo $row['pelanggaran']; ?>"
                                            data-tingkat="<?php echo $row['tingkat']; ?>"
                                            data-sanksi="<?php echo $row['sanksi']; ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#modalHapus"
                                            data-mahasiswa_id="<?php echo $row['pelanggaran']; ?>">Hapus</button>
                                    </div>
                                </td>

                            </tr><?php
                        }
                    }
                    ?>

                </tbody>
            </table>

            <!-- Modal for Adding New Rule -->
            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">Edit Peraturan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="edit_rule.php" method="POST">
                                <input type="hidden" name="pelanggaran_id" id="editPelanggaranId">
                                <div class="mb-3">
                                    <label for="editPelanggaran" class="form-label">Nama Pelanggaran</label>
                                    <input type="text" class="form-control" id="editPelanggaran" name="pelanggaran"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="editTingkat" class="form-label">Tingkat</label>
                                    <input type="text" class="form-control" id="editTingkat" name="tingkat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editSanksi" class="form-label">Sanksi</label>
                                    <input type="text" class="form-control" id="editSanksi" name="sanksi" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal for Editing Rule -->
            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">Edit Peraturan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="edit_rule.php" method="POST">
                                <input type="hidden" name="pelanggaran_id" id="editPelanggaranId">
                                <div class="mb-3">
                                    <label for="editPelanggaran" class="form-label">Nama Pelanggaran</label>
                                    <input type="text" class="form-control" id="editPelanggaran" name="pelanggaran"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="editTingkat" class="form-label">Tingkat</label>
                                    <input type="text" class="form-control" id="editTingkat" name="tingkat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editSanksi" class="form-label">Sanksi</label>
                                    <input type="text" class="form-control" id="editSanksi" name="sanksi" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Deleting Rule -->
            <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusLabel">Hapus Peraturan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="delete_rule.php" method="POST">
                                <input type="hidden" name="pelanggaran_id" id="hapusPelanggaranId">
                                <p>Apakah Anda yakin ingin menghapus peraturan ini?</p>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#example').DataTable();
                })
            </script>
            <script>
                $('.btn-edit').on('click', function () {
                    // Get data attributes from the clicked button
                    const pelanggaran = $(this).data('pelanggaran');
                    const tingkat = $(this).data('tingkat');
                    const sanksi = $(this).data('sanksi');

                    // Set values in the modal inputs
                    $('#editPelanggaran').val(pelanggaran);
                    $('#editTingkat').val(tingkat);
                    $('#editSanksi').val(sanksi);
                });
            </script>
</body>

</html>