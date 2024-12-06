<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Si Tertib - Admin Dashboard for Managing Rules and Data.">
  <meta name="keywords" content="Admin Dashboard, Rules, Student Data, Si Tertib">
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

    .welcome-container {
      margin: 20px auto;
      padding: 20px;
      width: 100%;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .welcome-container p {
      margin: 0;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .welcome-container .divider {
      width: 100%;
      height: 1px;
      background-color: #ccc;
      margin: 10px 0;
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
      transition: background-color 0.3s;
    }

    .btn-edit:hover {
      background-color: #e0a800;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-delete:hover {
      background-color: #c82333;
    }

    .btn-add {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      margin-bottom: 15px;
      transition: background-color 0.3s;
    }

    .btn-add:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <div class="menu">
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
    <h1>Dashboard</h1>
    <div class="welcome-container">
      <p>Selamat Datang Admin</p>
      <div class="divider"></div>
      <p>Sistem Tata Tertib</p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
