<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pelanggaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--Data Table -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
            font-size: 1.5rem;
        }

        .menu {
            flex-grow: 1;
        }

        .menu a {
            display: flex;
            align-items: center;
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
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardMhs.php"><i class="bi bi-house"></i> Dashboard</a>
            <a href="laporanMhs.php" class="active"><i class="bi bi-file-text"></i> Laporan</a>
            <a href="#punishment"><i class="bi bi-gavel"></i> Punishment</a>
            <a href="#history"><i class="bi bi-clock-history"></i> History Pelanggaran</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
    <div class="content">
        <h2>History Pelanggaran</h2>
        <div class="card">
            <div class="card-header">
                History Pelanggaran Mahasiswa
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggaran</th>
                            <th>Dosen Pelapor</th>
                            <th>Tingkat</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";

                        $user_id = $_COOKIE["user_id"];


                        $query = "SELECT d.nama, pl.pelanggaran, t.tingkat, CONVERT(date, p.tanggal) AS tanggal, p.status
                        FROM dbo.riwayat_pelaporan AS p
                        INNER JOIN dbo.mahasiswa AS m ON p.mahasiswa_id = m.mahasiswa_id
                        INNER JOIN dbo.kelas AS k ON k.kelas_id = m.kelas_id
                        INNER JOIN dbo.[user] AS u ON u.user_id = m.user_id
                        INNER JOIN dbo.dosen AS d ON d.dosen_id = p.dosen_id
                        INNER JOIN dbo.tingkat AS t ON p.tingkat_id = t.tingkat_id
                        INNER JOIN dbo.pelanggaran pl ON pl.pelanggaran_id = p.pelanggaran_id
                        WHERE u.user_id = ?";


                        $params = array($user_id);
                        $stmt = sqlsrv_prepare($conn, $query, $params);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }


                        if (sqlsrv_execute($stmt)) {
                            $no = 1;
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row["pelanggaran"] ?></td>
                                    <td><?php echo $row["nama"] ?></td>
                                    <td><?php echo $row["tingkat"] ?></td>
                                    <td><?php echo $row["tanggal"]->format('Y-m-d') ?></td>
                                    <td>
                                        <?php if ($row["status"] == "Dilaporkan") {
                                            echo "<span class='badge badge-danger'>Dilaporkan</span>";
                                        } else if ($row["status"] == "Selesai") {
                                            echo "<span class='badge badge-success'>Selesai</span>";
                                        } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        })
    </script>
</body>

</html>