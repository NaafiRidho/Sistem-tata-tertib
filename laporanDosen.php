<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggaran Dosen - Si Tertib</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #1a237e;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #3949ab;
            padding: 5px;
            border-radius: 5px;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .card {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #1e88e5;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
        }
        .form-buttons .btn {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-accept {
            background-color: #007bff;
            color: #fff;
        }
        .btn-accept:hover {
            background-color: #0056b3;
        }
        .btn-submit {
            background-color: #4caf50;
            color: #fff;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Si Tertib</h2>
        <a href="#"><i class="fas fa-th"></i> Dashboard</a>
        <a href="#"><i class="fas fa-comments"></i> Pelaporan</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header">Laporan</div>
        <div class="card">
            <div class="card-header">Data Laporan Mahasiswa</div>
            <form>
                <div class="form-group">
                    <label for="upload-bukti">Unggah Bukti <span style="color: red;">*</span></label>
                    <input type="file" id="upload-bukti" required>
                    <small>Ukuran Max: 5000kb</small>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mahasiswa <span style="color: red;">*</span></label>
                    <input type="text" id="nama" placeholder="Masukkan nama mahasiswa" required>
                </div>
                <div class="form-group">
                    <label for="nim">NIM <span style="color: red;">*</span></label>
                    <input type="text" id="nim" placeholder="Masukkan NIM mahasiswa" required>
                </div>
                <div class="form-group">
                    <label for="prodi">Prodi <span style="color: red;">*</span></label>
                    <select id="prodi" required>
                        <option value="" disabled selected>Pilih Program Studi</option>
                        <option value="TI">Teknik Informatika</option>
                        <option value="SI">Sistem Informasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas <span style="color: red;">*</span></label>
                    <select id="kelas" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal <span style="color: red;">*</span></label>
                    <input type="date" id="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="pelanggaran">Pelanggaran <span style="color: red;">*</span></label>
                    <input type="text" id="pelanggaran" placeholder="Masukkan jenis pelanggaran" required>
                </div>
                <div class="form-group">
                    <label for="sanksi">Sanksi <span style="color: red;">*</span></label>
                    <input type="text" id="sanksi" placeholder="Masukkan sanksi" required>
                </div>
                <div class="form-buttons">
                    <button type="button" class="btn btn-accept">ACCEPT</button>
                    <button type="submit" class="btn btn-submit">KIRIM</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Link FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Link Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
