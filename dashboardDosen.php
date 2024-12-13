<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Si Tertib Dashboard</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
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
      font-size: 2rem;
      font-family: 'Fugaz One', sans-serif;
      font-weight: 600;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 4);
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

    .card-dosen {
      margin-top: 20px;
      padding-left: 50px;
      padding-right: 50px;
    }

    .card {
      border-radius: 12px;
      border: 1px solid #ddd;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }

    .card .display-5 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .btn-primary {
      border-radius: 20px;
      padding: 8px 20px;
      width: 100%;
    }
  </style>
</head>

<body>
  <?php
  include "koneksi.php";

  $user_id = $_COOKIE['user_id'];
  $query = "SELECT COUNT(ab.banding_id) AS jumlahBanding FROM dosen AS d
            INNER JOIN riwayat_pelaporan AS rp ON rp.dosen_id = d.dosen_id
            INNER JOIN aju_banding AS ab ON ab.pelaporan_Id = rp.pelaporan_id
            INNER JOIN [user] AS u ON u.user_id = d.user_id
            WHERE u.user_id = 7 AND ab.status NOT IN ('Diterima','Ditolak')";
  $params = array($user_id);
  $stmt = sqlsrv_prepare($conn, $query, $params);
  if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  sqlsrv_execute($stmt);
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  ?>
  <div class="sidebar">
    <div class="menu" style="text-align: center; padding-top: 20px;">
      <img src="logo.png" style="width: 120px; height: 120px;">
      <h2>Si Tertib</h2>
      <a href="dashboardDosen.php" class="active"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="laporanDosen.php"><i class="bi bi-file-earmark-text"></i> Laporan</a>
      <a href="ajuBandingDosen.php"><i class="bi bi-envelope"></i> Aju Banding</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>


  <div class="content">
    <h1>Dashboard</h1>
    <div class="welcome-container">
      <p>Selamat Datang Dosen</p>
      <div class="divider"></div>
      <p>Sistem Tata Tertib</p>
    </div>
    <div class="card-dosen row mt-5">
      <div class="col-md-6">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pelaporan Aju Banding</h5>
            <p class="card-text display-5"><?php echo $row['jumlahBanding'] ?></p>
            <a href="ajuBandingDosen.php" class="btn btn-primary">
              <i class="bi bi-arrow-repeat"></i> Info Terbaru</a>
          </div>
        </div>
      </div>
      <?php
      include "koneksi.php";

      $user_id = $_COOKIE['user_id'];
      $query = "SELECT COUNT(rp.pelaporan_id) AS jumlahPelaporan FROM dosen AS d
            INNER JOIN riwayat_pelaporan AS rp ON rp.dosen_id = d.dosen_id
            INNER JOIN [user] AS u ON u.user_id = d.user_id
            WHERE u.user_id = 7 AND rp.status NOT IN ('Selesai','Dibatal')";
      $params = array($user_id);
      $stmt = sqlsrv_prepare($conn, $query, $params);
      if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
      }
      sqlsrv_execute($stmt);
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
      ?>
      <div class="col-md-6">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Total Jumlah Pelaporan</h5>
            <p class="card-text display-5"><?php echo $row['jumlahPelaporan']; ?></p>
            <a href="laporanDosen.php" class="btn btn-primary">
              <i class="bi bi-eye"></i> Lihat Detail
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>