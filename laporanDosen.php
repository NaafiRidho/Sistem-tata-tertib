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
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            background-color: #1e88e5;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        .form-group label {
            font-weight: bold;
            margin-top: 10px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .form-buttons .btn {
            width: 48%;
        }

        .image-preview {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 150px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-left: 10px;
        }

        .image-preview span {
            margin-left: 10px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardDosen.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="laporanDosen.php " class="active"><i class="bi bi-file-earmark-text"></i> Laporan</a>
            <a href="ajuBanding.php"><i class="bi bi-envelope"></i> Aju Banding</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
    <div class="content">
        <h1>Laporan</h1>
        <div class="card">
            <div class="card-header">Tambah Data Pelanggaran</div>
            <form>
                <div class="form-group">
                    <label for="upload-bukti">Unggah Bukti <span style="color: red;">*</span></label>
                    <input type="file" id="upload-bukti" required>
                    <small>Ukuran Max: 5000kb</small>
                </div>
                <div class="image-preview" id="image-preview">
                    <span>Image Not Available</span>
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
                    <button type="button" class="btn btn-primary"><i class="bi bi-check-circle"></i> ACCEPT</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> KIRIM</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set default tanggal saat ini
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').value = today;
        });

        // Preview gambar yang diupload
        const uploadBukti = document.getElementById('upload-bukti');
        const imagePreview = document.getElementById('image-preview');

        uploadBukti.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image Preview">`;
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = '<span>Image Not Available</span>';
            }
        });
    </script>
</body>

</html>