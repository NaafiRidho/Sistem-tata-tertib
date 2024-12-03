<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - List Tata Tertib</title>
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
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px 0;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.5rem;
    }

    .menu a {
      color: white;
      text-decoration: none;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1rem;
    }

    .menu a:hover {
      background-color: #0048c5;
    }

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .card {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      text-align: center;
      padding: 10px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn-edit {
      background-color: #ffc107;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <h2>Si Tertib</h2>
    <div class="menu">
      <a href="#"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="#"><i class="bi bi-list-check"></i> List Tata Tertib</a>
      <a href="#"><i class="bi bi-file-earmark"></i> Stempel</a>
    </div>
    <div class="menu mt-auto">
      <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <h1>List Tata Tertib</h1>
    <div class="card">
      <button class="btn btn-success mb-3">+ Peraturan Baru</button>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Pelanggaran</th>
            <th>Tingkat</th>
            <th>Sanksi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>Membuat surat pernyataan...</td>
            <td>
              <button class="btn-edit">Edit</button>
              <button class="btn-delete">Hapus</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>Membuat surat pernyataan...</td>
            <td>
              <button class="btn-edit">Edit</button>
              <button class="btn-delete">Hapus</button>
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
