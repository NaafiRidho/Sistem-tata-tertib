<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Si Tertib - Data Dosen">
    <meta name="keywords" content="Data Dosen, Si Tertib">
    <title>List Sanksi</title>
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
            <a href="listTataTertibAdmin.php"><i class="bi bi-list-check"></i> List Tata Tertib</a>
            <a href="listSanksiAdmin.php" class="active"><i class="bi bi-list-check"></i> List Sanksi</a>
            <a href="dataMhs.php"><i class="bi bi-person"></i> Data Mahasiswa</a>
            <a href="dataDosen.php"><i class="bi bi-person-badge"></i> Data Dosen</a>
            <a href="laporanAdmin.php"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>List Sanksi</h1>
        <div class="table-container">
            <div class="search-bar">
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAddRule">+ Buat Sanksi Baru</button>

            </div>
            <table id="example" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tingkat</th>
                        <th>Sanksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    require_once "Database.php";

                    $db = new Database($conn);
                    $query = "SELECT tingkat_id ,tingkat, sanksi FROM tingkat ORDER BY tingkat DESC";
                    // Execute the query
                    $stmt = $db->executeQuery($query);
                    $no = 1;

                    while ($row = $db->fetchAssoc($stmt)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['tingkat']; ?></td>
                            <td><?php echo $row['sanksi']; ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                        data-tingkat_id="<?php echo $row['tingkat_id']; ?>">
                                        Edit</button>
                                    <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#modalHapus"
                                        data-tingkat_id="<?php echo $row['tingkat_id']; ?>">
                                        Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Modal for Adding New Rule -->
            <div class="modal fade" id="modalAddRule" tabindex="-1" aria-labelledby="modalAddRuleLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddRuleLabel">Tambah Sanksi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="newTingkat" class="form-label">Tingkat</label>
                                    <select class="form-control newTingkat" id="newTingkat" name="tingkat" required>
                                        <option value="" disabled selected>Pilih Tingkat Sanksi</option>
                                        <?php
                                        include "koneksi.php";
                                        require_once 'Database.php';

                                        $db = new Database($conn);
                                        $query = "SELECT DISTINCT tingkat FROM tingkat";
                                        $stmt = $db->executeQuery($query);
                                        while ($row = $db->fetchAssoc($stmt)) {
                                            echo "<option value='" . $row['tingkat'] . "'>" . $row['tingkat'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="newSanksi" class="form-label">Sanksi</label>
                                    <textarea class="form-control" id="newSanksi" name="sanksi" require></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" id="saveNewSanksi">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal for Editing Rule -->
            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalAddRuleLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddRuleLabel">Tambah Sanksi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="newTingkat" class="form-label">Tingkat</label>
                                    <select class="form-control newTingkat" id="editTingkat" name="tingkat" required>
                                        <option value="" disabled selected>Pilih Tingkat Sanksi</option>
                                        <?php
                                        include "koneksi.php";
                                        require_once 'Database.php';

                                        $db = new Database($conn);
                                        $query = "SELECT DISTINCT tingkat FROM tingkat";
                                        $stmt = $db->executeQuery($query);
                                        while ($row = $db->fetchAssoc($stmt)) {
                                            echo "<option value='" . $row['tingkat'] . "'>" . $row['tingkat'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="newSanksi" class="form-label">Sanksi</label>
                                    <textarea class="form-control" id="editSanksi" name="sanksi" require></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" id="saveEdit">Simpan</button>
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
                                <button type="submit" class="btn btn-danger" id="btn-hapus">Hapus</button>
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
                $(document).ready(function() {
                    var table = $('#example').DataTable({
                        "pageLength": 10
                    });

                    $(document).on('click', '#saveNewSanksi', function() {
                        var tingkat = $('#newTingkat').val();
                        var sanksi = $('#newSanksi').val();

                        console.log({
                            tingkat,
                            sanksi
                        }); // Log data to ensure correctness

                        $.ajax({
                            url: "tambahSanksi.php",
                            method: "POST",
                            dataType: "JSON",
                            data: {
                                tingkat: tingkat,
                                sanksi: sanksi
                            },
                            success: function(response) {
                                if (response.status === "success") {
                                    alert(response.message);
                                    $("#modalAddRule").modal("hide");
                                    location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error: ", xhr.responseText);
                                alert("Terjadi kesalahan saat mengirim data ke server.");
                            }
                        });
                    });

                    $(document).on('click', '.btn-edit', function() {
                        var tingkat_id = $(this).data('tingkat_id');
                        $("#modalEdit").data('tingkat_id', tingkat_id);
                        $.ajax({
                            url: 'getTingkat.php',
                            type: 'GET',
                            data: {
                                tingkat_id: tingkat_id
                            },
                            success: function(response) {
                                var data = JSON.parse(response);
                                $('#editTingkat').val(data.tingkat);
                                $('#editSanksi').val(data.sanksi);
                            }
                        });

                        // Show the modal and remove the aria-hidden attribute
                        $('#modalEdit').modal('show').removeAttr('aria-hidden');
                    });

                    $('#modalEdit').on('hidden.bs.modal', function() {
                        // Add the aria-hidden attribute when the modal is hidden
                        $(this).attr('aria-hidden', 'true');
                    });

                    $(document).on('click', '#saveEdit', function() {
                        var tingkat_id = $("#modalEdit").data('tingkat_id');
                        var tingkat = $('#editTingkat').val();
                        var sanksi = $('#editSanksi').val();

                        $.ajax({
                            url: 'editTingkat.php',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                tingkat_id: tingkat_id,
                                tingkat: tingkat,
                                sanksi: sanksi
                            },
                            success: function(response) {
                                if (response.status === "success") {
                                    alert(response.message);
                                    $("#modalEdit").modal("hide");
                                    location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error: ", xhr.responseText);
                                alert("Terjadi kesalahan saat mengirim data ke server.");
                            }
                        });
                    });
                });
            </script>
</body>

</html>