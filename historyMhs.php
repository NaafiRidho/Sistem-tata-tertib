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

    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }

    .badge {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="menu">
    <h2>Si Tertib</h2>
    <a href="dashboardMhs.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
    <a href="laporanMhs.php"><i class="bi bi-file-text"></i> Laporan</a>
    <a href="punishmentMhs.php"><i class="bi bi-exclamation-circle"></i> Punishment</a>
    <a href="historyMhs.php"><i class="bi bi-clock-history"></i> History Pelanggaran</a>
  </div>
  <div class="logout">
    <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>

<div class="content">
  <h1>History Pelanggaran</h1>
  <div class="mt-4">
    <h2 class="mb-3 text-center">History Pelanggaran Mahasiswa</h2>
    <table class="table table-bordered table-striped">
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
        <tr>
          <td>1</td>
          <td>Melakukan tindakan kekerasan atau perkelahian di dalam kampus</td>
          <td>Ekojono, ST., M.Kom</td>
          <td>II</td>
          <td>23/11/2023</td>
          <td><span class="badge bg-success">Selesai</span></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Merusak sarana dan prasarana yang ada di area Polinema</td>
          <td>Budi Soeharto S.T., M.T</td>
          <td>II</td>
          <td>21/11/2024</td>
          <td><span class="badge bg-primary">On Progress</span></td>
        </tr>
      </tbody>
    </table>
    <p class="mt-3">Tingkat Pelanggaran Saat Ini: <strong>II</strong></p>
    <!-- Pagination -->
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
