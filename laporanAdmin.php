<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Si Tertib - Admin Dashboard for Managing Rules and Data.">
    <meta name="keywords" content="Admin Dashboard, Rules, Student Data, Si Tertib">
    <title>Si Tertib Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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

        .sidebar img {
            display: block;
            margin: 20px auto;
            border-radius: 30%;
        }

        .sidebar h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            font-family: 'Fugaz One', sans-serif;
            font-weight: 600;
            color: white;
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

        .welcome-container {
            margin: 20px auto;
            padding: 20px;
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-container p {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .welcome-container .divider {
            width: 100%;
            height: 1px;
            background-color: #ccc;
            margin: 10px 0;
        }

        .dataTables_paginate {
            float: right !important;
        }

        .dataTables_filter {
            float: right !important;
        }

        .table img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .btn-sm {
            width: 100px;
            text-align: center;
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
            <a href="dataMhs.php"><i class="bi bi-person"></i> Data Mahasiswa</a>
            <a href="dataDosen.php"><i class="bi bi-person-badge"></i> Data Dosen</a>
            <a href="laporanAdmin.php" class="active"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>Pelanggaran Mahasiswa</h1>
        <div class="card">
            <div class="card-header">Pelanggaran Mahasiswa Jurusan Teknologi Informasi</div>
            <div class="card-body mt-3">
                <table class="table table-bordered table-hover table-striped" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Dosen Pelapor</th>
                            <th>Pelanggaran</th>
                            <th>Tingkat</th>
                            <th>Tanggal</th>
                            <th>Sanksi</th>
                            <th>Bukti</th>
                            <th>Lihat Surat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";
                        require_once "Database.php";

                        $db = new Database($conn);
                        $query = "SELECT m.nama AS namaMhs, d.nama AS namaDosen, p.pelanggaran, t.tingkat, 
                          rp.tanggal, t.sanksi, rp.[file] AS buktiPelanggaran, dc.[file] AS doc 
                          FROM riwayat_pelaporan AS rp
                          INNER JOIN mahasiswa AS m ON m.mahasiswa_id = rp.mahasiswa_id
                          INNER JOIN dosen AS d ON d.dosen_id = rp.dosen_id
                          INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
                          INNER JOIN tingkat AS t ON t.tingkat_id = p.tingkat_id
                          INNER JOIN document AS dc ON dc.pelaporan_id = rp.pelaporan_id";
                        $stmt = $db->executeQuery($query);
                        $no = 1;
                        while ($row = $db->fetchAssoc($stmt)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['namaMhs']; ?></td>
                                <td><?php echo $row['namaDosen']; ?></td>
                                <td><?php echo $row['pelanggaran']; ?></td>
                                <td><?php echo $row['tingkat'] ?></td>
                                <td><?php echo $row['tanggal']->format('Y-m-d') ?></td>
                                <td><?php echo $row['sanksi'] ?></td>
                                <td>
                                    <?php $bukti =  $row['buktiPelanggaran']; ?>
                                    <img src="<?php echo $bukti ?>" alt="bukti">
                                </td>
                                <td class="text-center align-middle">
                                    <button id="lihatDoc" class="btn btn-primary btn-sm" data-doc="<?php echo $row['doc']; ?>">
                                        <i class="bi bi-eye"></i> Lihat
                                    </button>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i> Selesai
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
            $('#example').DataTable();

            $(document).on("click", "#lihatDoc", function() {
                var docUrl = $(this).data('doc');
                window.open(docUrl, '_blank'); 
            });
        });
    </script>
</body>

</html>
