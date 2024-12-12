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
      overflow: hidden;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease;
    }

    .sidebar h2 {
      text-align: center;
      color: white;
      margin: 20px 0;
      font-size: 2rem;
      font-family: 'Fugaz One', sans-serif;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 4);
    }

    .sidebar img {
      display: block;
      margin: 20px auto;
      border-radius: 30%;
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

    .alert-success {
      margin: 0 auto;
      text-align: center;
      padding: 15px;
      border-radius: 5px;
    }

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .content.shift {
      margin-left: 40px;
    }

    .dashboard-card {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
      margin-top: 60px;
    }

    .card {
      flex: 1;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      max-width: calc(33.33% - 20px);
      height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: space-around;
    }

    .card h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .card .btn {
      background-color: #00bcd4;
      color: white;
    }

    .card .btn:hover {
      background-color: #008c9e;
    }

    .card .btn:active {
      background-color: #005f70;
    }

    .card-header .card {
      max-width: 100%;
      margin-top: 30 px;
    }

    .greeting-text {
      font-size: 1.3 rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 5px;
    }

    .divider {
      border: 1px solid #ccc;
      margin: 10px 0;
    }

    .system-text {
      font-size: 1.2 rem;
      color: gray;
      margin-bottom: 0;
    }

    @media (min-width: 768px) {
      .greeting-text {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <div class="menu">
      <img src="logo.png" style="width: 120px; height: 120px;">
      <h2>Si Tertib</h2>
      <a href="dashboardMhs.php" class="active">
        <i class="bi bi-columns-gap"></i> <span>Dashboard</span>
      </a>
      <a href="laporanMhs.php">
        <i class="bi bi-file-text"></i> <span>Laporan</span>
      </a>
      <a href="punishmentMhs.php">
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

  <div class="content">
    <h1>Dashboard</h1>
    <div class="card-header d-flex align-items-center p-3" style="gap: 20px;">
      <!-- Gambar Profil -->
      <div class="rounded-circle" style="width: 180px; height: 180px; overflow: hidden;">
        <img src="pelanggaran/profilepic.png" alt="Foto Mahasiswa"
          style="width: 100%; height: 100%; object-fit: cover;">
      </div>

      <!-- Informasi Mahasiswa -->
      <div class="flex-grow-1 card" style="padding: 20px;">
        <?php
        include "koneksi.php";

        $query = "SELECT nama FROM mahasiswa WHERE user_id = ?";
        $params = array($_COOKIE['user_id']);
        $stmt = sqlsrv_prepare($conn, $query, $params);

        if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_execute($stmt);
        $nama = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)['nama'];
        ?>
        <p class="greeting-text">Selamat Datang, <?= htmlspecialchars($nama) ?></p>
        <!-- Garis Pembagi -->
        <hr style="border: 1px solid #ccc; margin: 10px 0;">
        <p style="font-size: 1rem; color: gray; margin-bottom: 0;">Sistem Tata Tertib</p>
      </div>
    </div>

    <!-- Status Dashboard -->
    <div class="container mt-4">
      <?php
      $query = "SELECT TOP 1 t.tingkat FROM riwayat_pelaporan AS p
            INNER JOIN mahasiswa AS m ON m.mahasiswa_id = p.mahasiswa_id
            INNER JOIN tingkat AS t ON t.tingkat_id = p.tingkat_id
            WHERE m.user_id = ? AND p.status <> 'Dibatalkan' ORDER BY t.tingkat";
      $params = array($_COOKIE['user_id']);
      $stmt = sqlsrv_prepare($conn, $query, $params);

      if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
      }

      sqlsrv_execute($stmt);
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

      if ($row) {
        $tingkat = htmlspecialchars($row['tingkat']);
        echo "
      <div class='alert alert-warning text-center' role='alert'>
          <strong>Tingkat Pelanggaran Saat Ini:</strong> $tingkat
      </div>";
      } else {
        echo "
      <div class='alert alert-success text-center' role='alert'>
          <strong>Mahasiswa belum melakukan pelanggaran.</strong>
      </div>";
      }
      ?>
    </div>
    <!-- Kartu Dashboard -->
    <div class="dashboard-card">
      <div class="card">
        <h3>Laporan</h3>
        <a href="laporanMhs.php" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
      <div class="card">
        <h3>Punishment</h3>
        <a href="punishmentMhs.php" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
      <div class="card">
        <h3>History Pelanggaran</h3>
        <a href="history_pelanggaran.php" class="btn btn-primary">Rincian &gt;&gt;</a>
      </div>
    </div>
  </div>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('close');
      document.querySelector('.content').classList.toggle('shift');
    }
  </script>
</body>

</html>