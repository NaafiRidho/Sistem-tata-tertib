<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Tertib</title>
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
            display: block;
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
        .btn-submit {
            background-color: #4caf50;
            color: #fff;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Si Tertib</h2>
        <a href="#" id="dashboard-link">Dashboard</a>
        <a href="#" id="laporan-link">Pelaporan</a>
        <a href="#">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Dashboard Section -->
        <div id="dashboard-section">
            <div class="header">Pelaporan</div>
            <div class="card">
                <div class="card-header">Pelaporan Pelanggaran Mahasiswa</div>
                <p>Maaf, data pelaporan saat ini belum ada</p>
                <button class="btn btn-success" id="add-report-button">+ Laporan Baru</button>
            </div>
        </div>

        <!-- Laporan Section -->
        <div id="laporan-section" class="hidden">
            <div class="header">Laporan</div>
            <div class="card">
                <div class="card-header">Data Laporan Mahasiswa</div>
                <form>
                    <div class="form-group">
                        <label>Unggah Bukti</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama mahasiswa">
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIM mahasiswa">
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select class="form-control">
                            <option value="TI">Teknik Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control">
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pelanggaran</label>
                        <input type="text" class="form-control" placeholder="Masukkan jenis pelanggaran">
                    </div>
                    <div class="form-group">
                        <label>Sanksi</label>
                        <input type="text" class="form-control" placeholder="Masukkan sanksi">
                    </div>
                    <div class="form-buttons">
                        <button type="button" class="btn btn-accept">ACCEPT</button>
                        <button type="submit" class="btn btn-submit" id="submit-report-button">KIRIM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // JavaScript for navigation
        const dashboardLink = document.getElementById('dashboard-link');
        const laporanLink = document.getElementById('laporan-link');
        const dashboardSection = document.getElementById('dashboard-section');
        const laporanSection = document.getElementById('laporan-section');
        const addReportButton = document.getElementById('add-report-button');
        const submitReportButton = document.getElementById('submit-report-button');

        // Show Dashboard
        dashboardLink.addEventListener('click', () => {
            dashboardSection.classList.remove('hidden');
            laporanSection.classList.add('hidden');
        });

        // Show Laporan Form
        laporanLink.addEventListener('click', () => {
            laporanSection.classList.remove('hidden');
            dashboardSection.classList.add('hidden');
        });

        // Redirect from Dashboard to Laporan Form
        addReportButton.addEventListener('click', () => {
            laporanSection.classList.remove('hidden');
            dashboardSection.classList.add('hidden');
        });

        // Simulate Report Submission
        submitReportButton.addEventListener('click', (event) => {
            event.preventDefault();
            alert('Laporan berhasil dikirim!');
            dashboardSection.classList.remove('hidden');
            laporanSection.classList.add('hidden');
        });
    </script>
</body>
</html>
