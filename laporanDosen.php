<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggaran Dosen - Si Tertib</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

        .sidebar h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
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

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
        }

        .card-header {
            background-color: #d3d3d3;
            color: black;
            text-align: center;
        }


        .alert-container {
            margin-top: 10px;
            padding: 20px;
            border-radius: 8px;
        }

        .alert-message {
            padding: 15px;
            background-color: #2196f3;
            color: white;
            border-radius: 5px;
            text-align: left;
        }

        .alert-button {
            margin-top: 10px;
            display: flex;
            justify-content: left;
        }

        .alert-button .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .alert-button .btn:hover {
            background-color: #218838;
        }

        .modal-body input,
        .modal-body select {
            margin-bottom: 15px;
        }

        .modal-body .form-group {
            margin-bottom: 20px;
        }

        .modal-body input:invalid {
            border-color: #e74c3c;
        }

        .modal-body input:valid {
            border-color: #2ecc71;
        }

        .modal-body .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            display: none;
        }

        .modal-body input:invalid+.error-message {
            display: block;
        }

        .image-preview {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 150px;
            margin-left: 10px;
            border-radius: 5px;
        }

        .image-preview span {
            margin-left: 10px;
            color: #999;
        }

        /* Menambahkan style untuk bintang */
        .required:after {
            content: " *";
            color: red;
        }

        .dataTables_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardDosen.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="laporanDosen.php" class="active"><i class="bi bi-file-earmark-text"></i> Laporan</a>
            <a href="ajuBanding.php"><i class="bi bi-envelope"></i> Aju Banding</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>Pelaporan</h1>
        <div class="card">
            <div class="card-header">Pelaporan Peanggaran Mahasiswa</div>
            <div class="alert-container">
                <?php
                include "koneksi.php";

                $user_id = $_COOKIE['user_id'];
                $query = "SELECT COUNT(*) AS total FROM riwayat_pelaporan AS r
                          INNER JOIN dosen AS d ON d.dosen_id = r.dosen_id
                          WHERE d.user_id = ? ";
                $params = array($user_id);
                $stmt = sqlsrv_prepare($conn, $query, $params);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                sqlsrv_execute($stmt);
                $total = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                if ($total['total'] > 0) {
                    $hasData = true;
                } else {
                    $hasData = false;
                }
                ?>
                <div class="alert-message" <?php if ($hasData) echo 'style="display: none;"'; ?>>
                    Maaf, data pelaporan saat ini belum ada.
                </div>
                <div class="alert-button">
                    <!-- Tombol untuk membuka modal -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#laporanBaruModal">
                        <i class="bi bi-plus-circle"></i> Laporan Baru
                    </button>
                </div>
            </div>
            <table id="example" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggaran</th>
                        <th>Tingkat</th>
                        <th>Sanksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT rp.tanggal, p.pelanggaran, t.tingkat, t.sanksi, rp.status FROM riwayat_pelaporan AS rp
                             INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
                             INNER JOIN tingkat AS t ON t.tingkat_id = rp.tingkat_id
                             INNER JOIN dosen AS d ON d.dosen_id = rp.dosen_id
                             WHERE d.user_id = ? ";
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
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['tanggal']->format('Y-m-d') ?></td>
                                <td><?php echo $row['pelanggaran'] ?></td>
                                <td><?php echo $row['tingkat'] ?></td>
                                <td><?php echo $row['sanksi'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                            </tr><?php
                                }
                            }
                                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="laporanBaruModal" tabindex="-1" aria-labelledby="laporanBaruModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporanBaruModalLabel">Tambah Data Pelanggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="dosenLapor.php">
                        <div class="form-group">
                            <label for="upload-bukti" class="required">Unggah Bukti</label>
                            <input type="file" id="upload-bukti" class="form-control" name="upload-bukti" required>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="required">Nama Mahasiswa</label>
                            <input type="text" id="nama" class="form-control" placeholder="Nama Mahasiswa" required>
                        </div>

                        <div class="form-group">
                            <label for="nim" class="required">NIM Mahasiswa</label>
                            <input type="text" id="nim" class="form-control" placeholder="NIM Mahasiswa" required>
                        </div>

                        <div class="form-group">
                            <label for="prodi" class="required">Program Studi</label>
                            <select id="prodi" class="form-control" required>
                                <option value="" disabled selected>Pilih Program Studi</option>
                                <?php
                                include 'koneksi.php'; // File koneksi ke SQL Server

                                $query = "SELECT DISTINCT prodi FROM kelas ORDER BY prodi"; // Query SQL
                                $result = sqlsrv_query($conn, $query); // Eksekusi query dengan sqlsrv_query

                                if ($result === false) {
                                    die(print_r(sqlsrv_errors(), true)); // Menampilkan error jika query gagal
                                }

                                // Menampilkan setiap prodi sebagai elemen <option>
                                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                    echo '<option value="' . htmlspecialchars($row['prodi']) . '">' . htmlspecialchars($row['prodi']) . '</option>';
                                }
                                ?>
                            </select>
                            <div class="error-message">Program Studi wajib dipilih.</div>
                        </div>

                        <div class="form-group">
                            <label for="kelas" class="required">Kelas</label>
                            <select id="kelas" class="form-control" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                            </select>
                            <div class="error-message">Kelas wajib dipilih.</div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="required">Tanggal</label>
                            <input type="date" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="pelanggaran" class="required">Pelanggaran</label>
                            <select name="pelanggaran" id="pelanggaran" class="form-control">
                                <option value="" disabled selected>Pilih Pelanggaran</option>
                                <?php
                                $query = "SELECT tingkat_id ,pelanggaran FROM pelanggaran ORDER BY pelanggaran";
                                $result = sqlsrv_query($conn, $query);

                                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                    echo '<option value="' . htmlspecialchars($row['pelanggaran']) . '" data-tingkat_id="' . htmlspecialchars($row['tingkat_id']) . '">' . htmlspecialchars($row['pelanggaran']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sanksi" class="required">Sanksi</label>
                            <input type="text" id="sanksi" class="form-control" placeholder="Sanksi" required readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="simpanLaporan">Simpan</button>
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
            const hasData = <?php echo json_encode($hasData); ?>;
            if (hasData) {
                $('#example').DataTable({
                    lengthChange: false // Menghilangkan dropdown "Show entries"
                });
            } else {
                $('#example').hide(); // Sembunyikan tabel jika tidak ada data
            }
            $('#prodi').change(function() {
                const prodi = $(this).val(); // Ambil nilai dari dropdown prodi
                const kelasDropdown = $('#kelas'); // Dropdown kelas

                // Bersihkan dropdown kelas dan tampilkan opsi placeholder
                kelasDropdown.empty().append('<option value="" disabled selected>Memuat Kelas...</option>');

                // AJAX request untuk memuat kelas berdasarkan prodi
                $.ajax({
                    url: 'get_kelas.php',
                    method: 'GET',
                    data: {
                        prodi: prodi
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Bersihkan dropdown kelas dan tambahkan opsi baru
                        kelasDropdown.empty().append('<option value="" disabled selected>Pilih Kelas</option>');
                        $.each(data, function(index, kelas) {
                            kelasDropdown.append('<option value="' + kelas.nama_kelas + '">' + kelas.nama_kelas + '</option>');
                        });
                    },
                    error: function() {
                        // Tampilkan pesan error jika terjadi kesalahan
                        kelasDropdown.empty().append('<option value="" disabled selected>Error memuat kelas</option>');
                    }
                });
            });
            $("#pelanggaran").change(function() {
                var tingkat_id = $("#pelanggaran option:selected").data("tingkat_id");

                $.ajax({
                    url: 'get_sanksi.php',
                    method: 'GET',
                    data: {
                        tingkat_id: tingkat_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#sanksi').val(response.sanksi);
                    },
                    error: function() {
                        alert("Error fetching sanksi data.");
                    }
                });
            });
            // Kirimkan data menggunakan AJAX
            $("#simpanLaporan").click(function() {
                var formData = new FormData();

                // Ambil data dari form
                formData.append("nama", $("#nama").val());
                formData.append("nim", $("#nim").val());
                formData.append("prodi", $("#prodi").val());
                formData.append("kelas", $("#kelas").val());
                formData.append("pelanggaran", $("#pelanggaran").val());
                formData.append("sanksi", $("#sanksi").val());
                formData.append("tanggal", $("#tanggal").val());

                // Ambil file
                var fileInput = $("#upload-bukti")[0];
                if (fileInput.files.length > 0) {
                    formData.append("upload-bukti", fileInput.files[0]);
                }

                // Kirim data menggunakan AJAX
                $.ajax({
                    url: "dosenLapor.php", // URL file PHP
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert('Laporan berhasil diterima!');
                        $("#laporanBaruModal").modal("hide");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", xhr.responseText);
                        alert("Terjadi kesalahan saat mengirim data ke server.");
                    },
                });
            });
        });
    </script>

</body>

</html>