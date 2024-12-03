<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Si Tertib Pelaporan</title>
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

    .card {
      margin-bottom: 20px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn {
      padding: 5px 10px;
      font-size: 0.9rem;
      border-radius: 4px;
      text-decoration: none;
      color: white;
    }

    .btn-accept {
      background-color: #28a745;
    }

    .btn-accept:hover {
      background-color: #218838;
    }

    .btn-reject {
      background-color: #dc3545;
      color: white;
    }

    .btn-reject:hover {
      background-color: #c82333;
    }

    img {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="menu">
      <h2>Si Tertib</h2>
      <a href="dashboardDosen.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="laporanDosen.php"><i class="bi bi-file-earmark-text"></i> Laporan</a>
      <a href="ajuBandingDosen.php"><i class="bi bi-envelope"></i> Aju Banding</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <!-- Heading di luar container -->
    <h1>Aju Banding Mahasiswa</h1>

    <div class="card">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <label for="entries">Show</label>
          <select id="entries" class="form-select d-inline-block" style="width: auto;">
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
          </select>
          entries
        </div>
        <div>
          <label for="search">Search:</label>
          <input id="search" type="text" class="form-control d-inline-block" style="width: auto;">
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Pelanggaran</th>
            <th>Sanksi</th>
            <th>Alasan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Naafi Ridho Athallah</td>
            <td>Makan, atau minum di dalam ruang kuliah/laboratorium/bengkel.</td>
            <td>Teguran tertulis, surat pernyataan tidak mengulangi perbuatan tersebut (dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA)</td>
            <td>Pekerjaan mendesak dan lupa membawa botol minum ke luar ruangan.</td>
            <td>
              <a href="#" class="btn btn-accept mb-1">Terima</a>
              <br>
              <a href="#" class="btn btn-reject">Tolak</a>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-between align-items-center mt-3">
        <p>Showing 1 to 1 of 1 entries</p>
        <nav>
          <ul class="pagination">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
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
