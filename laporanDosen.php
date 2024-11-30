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
                <div class="alert-message">
                    Maaf, data pelaporan saat ini belum ada.
                </div>
                <div class="alert-button">
                    <!-- Tombol untuk membuka modal -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#laporanBaruModal">
                        <i class="bi bi-plus-circle"></i> Laporan Baru
                    </button>
                </div>
            </div>
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
                    <form>
                        <div class="form-group">
                            <label for="upload-bukti" class="required">Unggah Bukti</label>
                            <input type="file" id="upload-bukti" class="form-control" required>
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
                                <option value="TI">Teknik Informatika</option>
                                <option value="SI">Sistem Informasi Bisnis</option>
                            </select>
                            <div class="error-message">Program Studi wajib dipilih.</div>
                        </div>

                        <div class="form-group">
                            <label for="kelas" class="required">Kelas</label>
                            <select id="kelas" class="form-control" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="A">Kelas A</option>
                                <option value="B">Kelas B</option>
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
                            <input type="text" id="pelanggaran" class="form-control" placeholder="Pelanggaran" required>
                        </div>

                        <div class="form-group">
                            <label for="sanksi" class="required">Sanksi</label>
                            <input type="text" id="sanksi" class="form-control" placeholder="Sanksi" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>