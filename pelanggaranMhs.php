<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Si Tertib - Pelanggaran Mahasiswa">
  <meta name="keywords" content="Si Tertib, Pelanggaran Mahasiswa">
  <title>Pelanggaran Mahasiswa - Teknologi Informasi</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }

    .sidebar {
      width: 240px;
      background-color: #002a8a;
      position: fixed;
      height: 100%;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .menu a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
      padding: 15px;
      text-decoration: none;
      border-left: 5px solid transparent;
      transition: all 0.3s;
    }

    .menu a:hover {
      background-color: #0056b3;
      border-left: 5px solid #ffcc00;
    }

    .logout {
      margin-top: auto;
    }

    .logout a {
      display: block;
      text-align: center;
      padding: 10px;
      background-color: #d9534f;
      color: white;
      text-decoration: none;
    }

    .logout a:hover {
      background-color: #c9302c;
    }

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .table-container {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: center;
      padding: 10px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .status-dropdown {
      border: none;
      background: none;
      color: #007bff;
      cursor: pointer;
    }

    .sidebar img {
      display: block;
      margin: 20px auto; 
      border-radius: 30%; 
    }
    
    .status-dropdown:hover {
      text-decoration: underline;
    }

    .header-title {
      font-size: 24px;
      font-weight: 600;
      color: #000000; 
      text-transform: none;
      letter-spacing: 0;
    }

    .subheader {
      font-size: 20px;
      font-weight: 500;
      color: #000000; 
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="menu">
    <img src="logo.png" style="width: 120px; height: 120px;">
    <h2>Si Tertib</h2>
      <a href="#dashboard"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="#listTatib"><i class="bi bi-list-check"></i> List Tata Tertib</a>
      <a href="#dataMahasiswa"><i class="bi bi-person"></i> Data Mahasiswa</a>
      <a href="#dataDosen"><i class="bi bi-person-badge"></i> Data Dosen</a>
      <a href="#pelanggaranMahasiswa"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <h1 class="header-title">Laporan</h1>
    <div class="mb-4 subheader">Pelanggaran Mahasiswa Jurusan Teknologi Informasi</div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Dosen Pelapor</th>
            <th>Pelanggaran</th>
            <th>Tingkat</th>
            <th>Tanggal</th>
            <th>Sanksi</th>
            <th>Bukti</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Abhinaya Nuzuluzzuhdi</td>
            <td>Ruli Rahayu S.P, M.I</td>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>21/07/2024</td>
            <td>Membuat surat pernyataan, dibubuhi materai</td>
            <td><img src="https://via.placeholder.com/50" alt="Bukti"></td>
            <td>
              <select class="status-dropdown">
                <option value="selesai">Selesai</option>
                <option value="proses">Proses TTD</option>
                <option value="dibatalkan">Dibatalkan</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Abhinaya Nuzuluzzuhdi</td>
            <td>Budi Soeharto S.T, M.T</td>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>21/07/2024</td>
            <td>Membuat surat pernyataan, dibubuhi materai</td>
            <td><img src="https://via.placeholder.com/50" alt="Bukti"></td>
            <td>
              <select class="status-dropdown">
                <option value="selesai">Selesai</option>
                <option value="proses">Proses TTD</option>
                <option value="dibatalkan">Dibatalkan</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-between mt-3">
        <span>Showing 1 to 2 of 2 entries</span>
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
