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
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      padding: 15px;
      font-size: 1rem;
      text-decoration: none;
      background-color: #d9534f;
      transition: background-color 0.3s ease;
    }

    .logout a:hover {
      background-color: #c9302c;
    }

    .content {
      margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
      padding: 20px;
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
  </style>
</head>
<body>

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
    <a href="punishment.php" class="active">
      <i class="bi bi-exclamation-circle"></i> <span>Punishment</span>
    </a>
    <a href="historyMhs.php">
      <i class="bi bi-clock-history"></i> <span>History Pelanggaran</span>
    </a>
  </div>
  <div class="logout">
    <a href="login.php">
      <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
    </a>
  </div>
</div>

<!-- Content -->
<div class="content">
  <h2>Punishment</h2>
  <button class="btn-cetak-surat btn btn-primary">
    <i class="bi bi-printer"></i> Cetak Surat
  </button>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
