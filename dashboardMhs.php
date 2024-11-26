<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Si Tertib Dashboard</title>
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

    .dashboard-card {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      flex: 1;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      max-width: calc(33.33% - 20px);
    }

    .card h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .card .btn {
      margin-top: 10px;
      background-color: #00bcd4;
      color: white;
    }

    .card .btn:hover {
      background-color: #008c9e;
    }

    .card .btn:active {
      background-color: #005f70;
    }
  </style>
</head>

<body>

<div class="sidebar">
  <div class="menu">
    <h2>Si Tertib</h2>
    <a href="dashboardMhs.php"><i class="bbi bi-columns-gap"></i> Dashboard</a>
    <a href="laporanMhs.php"><i class="bi bi-file-text"></i> Laporan</a>
    <a href="punishmentMhs.php"><i class="bi bi-exclamation-circle"></i> Punishment</a>
    <a href="history_pelanggaran.php"><i class="bi bi-clock-history"></i> History Pelanggaran</a>
  </div>
  <div class="logout">
    <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>


  <div class="content">
    <h1>Dashboard</h1>
    <div>
      <p style="font-size: 1.3rem; font-weight: bold; text-align: center; margin-bottom: 5px;">Selamat Datang Mahasiswa</p>
      <p style="text-align: center; margin-bottom: 20px;">Sistem Tata Tertib</p>
    </div>

    <!-- Kartu Dashboard -->
    <div class="dashboard-card">
      <div class="card">
        <h3>Laporan</h3>
        <a href="laporanMhs.php" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
      <div class="card">
        <h3>Punishment</h3>
        <a href="#punishment-details" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
      <div class="card">
        <h3>History Pelanggaran</h3>
        <a href="history_pelanggaran.php" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
    </div>

    <!-- Tabel Pelanggaran -->
    <div class="mt-4">
      <h2 class="mb-3">Daftar Pelanggaran</h2>
      <div id="pelanggaran-container">
        <!-- Pesan jika tidak ada pelanggaran -->
        <p class="text-center text-muted" id="no-pelanggaran">Kamu belum melakukan pelanggaran.</p>
        <!-- Tabel akan disembunyikan jika tidak ada data -->
        <table class="table table-bordered table-striped d-none" id="pelanggaran-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Pelanggaran yang Dilakukan</th>
              <th>Tingkat Pelanggaran</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data pelanggaran -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Data pelanggaran dengan tingkat pelanggaran 5 (ringan) hingga 1 (berat)
    const dataPelanggaran = [{
        nomor: 1,
        pelanggaran: "Terlambat Masuk Kelas",
        tingkat: 5
      },
      {
        nomor: 2,
        pelanggaran: "Tidak Mengumpulkan Tugas",
        tingkat: 4
      },
      {
        nomor: 3,
        pelanggaran: "Tidak Memakai Seragam",
        tingkat: 3
      },
      {
        nomor: 4,
        pelanggaran: "Tidak Mengikuti Upacara",
        tingkat: 2
      },
      {
        nomor: 5,
        pelanggaran: "Membawa Barang Terlarang",
        tingkat: 1
      },
    ];

    const table = document.getElementById('pelanggaran-table');
    const noPelanggaranMessage = document.getElementById('no-pelanggaran');

    if (dataPelanggaran.length > 0) {
      noPelanggaranMessage.classList.add('d-none');
      table.classList.remove('d-none');
      const tbody = table.querySelector('tbody');
      tbody.innerHTML = dataPelanggaran
        .map(
          (item) => `
      <tr>
        <td>${item.nomor}</td>
        <td>${item.pelanggaran}</td>
        <td>${item.tingkat}</td>
      </tr>
    `
        )
        .join('');
    }
  </script>
</body>

</html>