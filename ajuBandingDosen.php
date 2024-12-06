<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aju Banding Dosen - Si Tatib</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

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
            overflow: hidden;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            font-family: 'Fugaz One', sans-serif;
            font-weight: 600;
            color: #E38E49;
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
            padding: 15px 20px;
            text-decoration: none;
            font-size: 1rem;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }

        .menu a:hover {
            background-color: #0056b3;
            border-left: 5px solid #ffcc00;
        }

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
        <div class="menu" style="text-align: center; padding-top: 20px;">
            <img src="logo.png" style="width: 120px; height: 120px;">
            <h2>Si Tertib</h2>
            <a href="dashboardDosen.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="laporanDosen.php"><i class="bi bi-file-earmark-text"></i> Laporan</a>
            <a href="ajuBandingDosen.php" class="active"><i class="bi bi-envelope"></i> Aju Banding</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
    <div class="content">
        <h1>Aju Banding</h1>
        <div class="card">
            <div class="card-header">Pengajuan Banding Dari Mahasiswa</div>
            <div class="card-body mt-3">
                <table class="table table-bordered table-hover table-striped" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Pelanggaran</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";

                        $user_id = $_COOKIE['user_id'];
                        $query = "SELECT ab.banding_id, m.nama, p.pelanggaran, ab.tanggal_pengajuan, ab.alasan FROM aju_banding AS ab
                                  INNER JOIN riwayat_pelaporan AS rp ON rp.pelaporan_id = ab.pelaporan_Id
                                  INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
                                  INNER JOIN mahasiswa AS m ON m.mahasiswa_id = rp.mahasiswa_id
                                  INNER JOIN dosen AS d ON d.dosen_id = rp.dosen_id
                                  INNER JOIN [user] AS u ON u.user_id = d.user_id
                                  WHERE d.user_id = ? AND ab.status NOT IN ('Ditolak','Diterima')";

                        $params = array($user_id);
                        $stmt = sqlsrv_prepare($conn, $query, $params);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        if (sqlsrv_execute($stmt)) {
                            $no = 1;
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        ?> <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['pelanggaran'] ?></td>
                                    <td><?php echo $row['tanggal_pengajuan']->format('Y-m-d') ?></td>
                                    <td><?php echo $row['alasan'] ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-danger btn-sm mb-2" id="btnTolak" data-bs-toggle="modal"
                                                data-bs-target="#modalTolak"
                                                data-banding_id="<?php echo $row['banding_id']; ?>">Tolak</button>
                                            <button class="btn btn-success btn-sm" id="btnTerima" data-bs-toggle="modal"
                                                data-bs-target="#modalTerima"
                                                data-banding_id="<?php echo $row['banding_id']; ?>">Terima</button>
                                        </div>
                                    </td>
                                </tr><?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tolak -->
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Aju Banding Pelanggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda Ingin Menolak Aju Banding
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tolak">Iya</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Terima -->
    <div class="modal fade" id="modalTerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Aju Banding Pelanggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda Ingin Menerima Aju Banding
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="terima">Iya</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on('click', '#btnTolak', function() {
                var banding_id = $(this).data("banding_id");
                $("#modalTolak").data('banding_id', banding_id);
            });

            $("#tolak").click(function() {
                var banding_id = $("#modalTolak").data('banding_id');
                $.ajax({
                    url: "tolakBanding.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        banding_id: banding_id
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#modalTolak").modal("hide");
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '#btnTerima', function() {
                var banding_id = $(this).data("banding_id");
                $("#modalTerima").data('banding_id', banding_id);
            });
            $("#terima").click(function() {
                var banding_id = $("#modalTerima").data('banding_id');
                $.ajax({
                    url: "terimaBanding.php",
                    method: "POST",
                    data: {
                        banding_id: banding_id
                    },
                    dataType: "json",

                    success: function(response) {
                        alert(response.message);
                        $("#modalTerima").modal("hide");
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            })
        });
    </script>
</body>

</html>