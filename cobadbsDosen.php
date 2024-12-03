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

    .dashboard-header {
      font-size: 2rem;
      font-weight: bold;
      color: #002a8a;
      text-align: left;
      margin-bottom: 20px;
    }

    .welcome-card {
      margin: 1 auto;
      max-width: 2000px;
      height: 120px;
      padding: 30px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .welcome-card h1 {
      font-size: 2rem;
      font-weight: bold;
      margin: 0;
      color: #002a8a;
    }

    .welcome-card p {
      font-size: 1.2rem;
      color: #555;
      margin-top: 5px;
    }

    .line {
      margin: 20px auto;
      width: 60%;
      height: 1px;
      background-color: #ddd;
    }

    .table-container {
      margin: 60px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #002a8a;
      text-align: center;
      margin-bottom: 20px;
    }

    .btn-edit {
      background-color: #ffc107;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-edit:hover {
      background-color: #e0a800;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-delete:hover {
      background-color: #c82333;
    }

    tr:hover {
      background-color: #f1f8ff;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="menu">
      <h2>Si Tertib</h2>
      <a href="dashboardDosen.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="laporanDosen.php"><i class="bi bi-file-earmark-text"></i> Laporan</a>
      <a href="ajuBanding.php"><i class="bi bi-envelope"></i> Aju Banding</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Dashboard Header -->
    <div class="dashboard-header">Dashboard</div>

    <!-- Welcome Card -->
    <div class="welcome-card">
      <h1>Selamat Datang Dosen</h1>
      <p>Sistem Tata Tertib</p>
    </div>

    <!-- Table -->
    <div class="table-container">
      <p class="table-title">Pengajuan Banding dari Mahasiswa</p>
      <table class="table table-hover">
        <thead class="table-primary">
          <tr>
            <th>Pelanggaran</th>
            <th>Tingkat</th>
            <th>Sanksi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA</td>
            <td>
              <button class="btn-edit"><i class="bi bi-pencil"></i> Edit</button>
              <button class="btn-delete"><i class="bi bi-trash"></i> Hapus</button>
            </td>
          </tr>
          <tr>
            <td>Melanggar aturan pakaian</td>
            <td>II</td>
            <td>Mengikuti konseling dengan pihak terkait</td>
            <td>
              <button class="btn-edit"><i class="bi bi-pencil"></i> Edit</button>
              <button class="btn-delete"><i class="bi bi-trash"></i> Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
