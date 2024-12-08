<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punishment - Si Tertib</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            transition: transform 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
        }

        .sidebar.close {
            transform: translateX(-100%);
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
            transition: all 0.3s ease;
        }

        .menu a.active {
            background-color: #0056b3;
            border-left: 5px solid #ffcc00;
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
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.shift {
            margin-left: 40px;
            transition: margin-left 0.3s ease;
        }

        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #002a8a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 100;
        }

        .btn-cetak-surat {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-cetak-surat:hover {
            background-color: #218838;
        }

        .btn-upload-label {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-upload-label:hover {
            background-color: #218838;
        }

        /* Hide the default file input */
        input[type="file"] {
            display: none;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 40px;
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

    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardMhs.php">
                <i class="bi bi-columns-gap"></i> <span>Dashboard</span>
            </a>
            <a href="laporanMhs.php">
                <i class="bi bi-file-text"></i> <span>Laporan</span>
            </a>
            <a href="punishmentMhs.php" class="active">
                <i class="bi bi-exclamation-circle"></i> <span>Punishment</span>
            </a>
            <a href="history_pelanggaran.php">
                <i class="bi bi-clock-history"></i> <span>History Pelanggaran</span>
            </a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Punishment</h2>
        <table class="table table-bordered table-hover table-striped" id="example">
            <thead>
                <tr>
                    <th>No
                    <th>PelaporanId</th>
                    <th>Pelanggaran</th>
                    <th>Sanksi</th>
                    <th>Tingkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";

                $user_id = $_COOKIE['user_id'];
                $query = "SELECT rp.pelaporan_id, p.pelanggaran, t.sanksi, t.tingkat, m.mahasiswa_id, k.kelas_id, rp.tanggal FROM riwayat_pelaporan AS rp 
                          INNER JOIN mahasiswa AS m ON rp.mahasiswa_id = m.mahasiswa_id
                          INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
                          INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
                          INNER JOIN tingkat AS t ON t.tingkat_id = p.tingkat_id
                          INNER JOIN [user] AS u ON u.user_id = m.user_id
                          WHERE u.user_id= ? AND rp.status NOT IN('Selesai', 'Dibatalkan')";
                $params = array($user_id);
                $stmt = sqlsrv_prepare($conn, $query, $params);
                if ($stmt == false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                if (sqlsrv_execute($stmt)) {
                    $no = 1;
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                ?><tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['pelaporan_id'] ?></td>
                            <td><?php echo $row['pelanggaran'] ?></td>
                            <td><?php echo $row['sanksi'] ?></td>
                            <td><?php echo $row['tingkat'] ?></td>
                            <td>
                                <button class="btn-cetak-surat btn btn-primary" data-pelanggaran_id="<?php echo htmlspecialchars($row['pelaporan_id']); ?>">
                                    <i class="bi bi-printer"></i> Cetak Surat
                                </button>
                                <button class="btn-upload-surat btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modalUpload" data-pelanggaran_id="<?php echo htmlspecialchars($row['pelaporan_id']); ?>"
                                    data-mahasiswa_id="<?php echo htmlspecialchars($row['mahasiswa_id']); ?>" data-kelas_id="<?php echo htmlspecialchars($row['kelas_id']); ?>"
                                    data-pelanggaran="<?php echo htmlspecialchars($row['pelanggaran']); ?>" data-sanksi="<?php echo htmlspecialchars($row['sanksi']); ?>">
                                    <i class="bi bi-cloud-arrow-up"></i> Unggah
                                </button>
                            </td>
                        </tr><?php
                            }
                        }
                                ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Judul Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body Modal -->
                <div class="modal-body">
                    <img id="gambar" src="" alt="">
                    <form enctype="multipart/form-data" method="POST" action="dosenLapor.php">
                        <div class="form-group">
                            <label for="nama" class="required">Nama Mahasiswa</label>
                            <input type="text" id="nama" class="form-control" placeholder="Nama Mahasiswa" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nim" class="required">NIM Mahasiswa</label>
                            <input type="text" id="nim" class="form-control" placeholder="NIM Mahasiswa" readonly>
                        </div>

                        <div class="form-group">
                            <label for="prodi" class="required">Program Studi</label>
                            <input type="text" id="prodi" class="form-control" placeholder="Prodi Mahasiswa" readonly>
                        </div>

                        <div class="form-group">
                            <label for="kelas" class="required">Kelas</label>
                            <input type="text" id="kelas" class="form-control" placeholder="Kelas" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="required">Tanggal</label>
                            <input type="date" id="tanggal" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="pelanggaran" class="required">Pelanggaran</label>
                            <input type="text" id="pelanggaran" class="form-control" placeholder="pelanggaran" readonly>
                        </div>

                        <div class="form-group">
                            <label for="sanksi" class="required">Sanksi</label>
                            <input type="text" id="sanksi" class="form-control" placeholder="Sanksi" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="upload-surat" class="required">Unggah Bukti</label>
                            <input type="file" id="upload-surat" class="form-control" name="upload-surat" required>
                        </div>
                    </form>
                </div>
                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('close');
            document.querySelector('.content').classList.toggle('shift');
        }
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on('click', '.btn-cetak-surat', function() {
                const pelanggaran_id = $(this).data('pelanggaran_id');

                window.location.href = `suratPunishment.php?pelanggaran_id=${pelanggaran_id}`;
            });

            $(document).on('click', '.btn-upload-surat', function() {
                const pelanggaran_id = $(this).data('pelanggaran_id');
                const mahasiswa_id = $(this).data('mahasiswa_id');
                const kelas_id = $(this).data('kelas_id');
                const pelanggaran = $(this).data('pelanggaran');
                const sanksi = $(this).data('sanksi');
                $('#pelanggaran').val(pelanggaran);
                $('#sanksi').val(sanksi);

                $.ajax({
                    type: 'GET',
                    url: 'getRiwayatPelanggaran.php',
                    data: {
                        mahasiswa_id: mahasiswa_id,
                        kelas_id: kelas_id,
                        pelanggaran_id: pelanggaran_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#nama').val(data.namamhs);
                        $('#kelas').val(data.nama_kelas);
                        $('#nim').val(data.nim);
                        $('#prodi').val(data.prodi);
                        $('#tanggal').val(data.tanggal);
                        $('#gambar').attr('src', data.file);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                })
            })
        })
    </script>
</body>

</html>