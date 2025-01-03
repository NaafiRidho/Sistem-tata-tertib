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
      color: white;
      display: flex;
      flex-direction: column;
    }

    .sidebar img {
      display: block;
      margin: 20px auto;
      border-radius: 30%;
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
      padding: 15px;
      text-decoration: none;
      border-left: 5px solid transparent;
      transition: all 0.3s;
    }

    .menu a:hover,
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

    .btn-primary {
      border-radius: 20px;
      padding: 8px 20px;
      width: 100%;
    }

    .card {
      border-radius: 12px;
      border: 1px solid #ddd;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card .display-4 {
      font-size: 3rem;
    }

    .card .btn-primary {
      border-radius: 20px;
      padding: 8px 20px;
    }

    .chart-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
    }
  </style>
</head>

<body onload=getData()>
  <div class="sidebar">
    <div class="menu">
      <img src="logo.png" style="width: 120px; height: 120px;">
      <h2>Si Tertib</h2>
      <a href="dashboardAdmin.php" class="active"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="listTataTertibAdmin.php"><i class="bi bi-list-check"></i> List Tata Tertib</a>
      <a href="listSanksiAdmin.php"><i class="bi bi-list-check"></i> List Sanksi</a>
      <a href="dataMhs.php"><i class="bi bi-person"></i> Data Mahasiswa</a>
      <a href="dataDosen.php"><i class="bi bi-person-badge"></i> Data Dosen</a>
      <a href="laporanAdmin.php"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <div class="content-1">
      <h1>Dashboard</h1>
      <div class="welcome-container">
        <p>Selamat Datang Admin</p>
        <div class="divider"></div>
        <p>Sistem Tata Tertib</p>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Card 1 -->
        <div class="col">
          <div class="card text-center shadow-sm h-100">
            <div class="card-body">
              <i class="bi bi-check-circle display-4 text-primary mb-3"></i>
              <h5 class="card-title">Jumlah Penyelesaian Pelanggaran</h5>
              <?php
              include "koneksi.php";
              require_once "Database.php";

              $db = new Database($conn);
              $query = "SELECT COUNT(*) AS jumlahPenyelesaian FROM document AS d
                    INNER JOIN riwayat_pelaporan AS rp ON rp.pelaporan_id = d.pelaporan_id";
              $stmt = $db->executeQuery($query);
              $row = $db->fetchAssoc($stmt);
              ?>
              <p class="card-text display-5"><?php echo $row['jumlahPenyelesaian'] ?></p>
              <a href="laporanAdmin.php" class="btn btn-primary">
                <i class="bi bi-info-circle-fill"></i> Info Terbaru</a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
          <div class="card text-center shadow-sm h-100">
            <div class="card-body">
              <i class="bi bi-person-circle display-4 text-warning mb-3"></i>
              <h5 class="card-title">Jumlah Dosen</h5>
              <?php
              $query = "SELECT COUNT(*) AS jumlahDosen FROM dosen";
              $stmt = $db->executeQuery($query);
              $row = $db->fetchAssoc($stmt);
              ?>
              <p class="card-text display-5"><?php echo $row['jumlahDosen'] ?></p>
              <a href="dataDosen.php" class="btn btn-primary">
                <i class="bi bi-info-circle-fill"></i> Info Terbaru</a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
          <div class="card text-center shadow-sm h-100">
            <div class="card-body">
              <i class="bi bi-people-fill display-4 text-success mb-3"></i>
              <h5 class="card-title">Jumlah Mahasiswa</h5>
              <?php
              $query = "SELECT COUNT(*) AS jumlahMahasiswa FROM mahasiswa";
              $stmt = $db->executeQuery($query);
              $row = $db->fetchAssoc($stmt);
              ?>
              <p class="card-text display-5"><?php echo $row['jumlahMahasiswa'] ?></p>
              <a href="dataMhs.php" class="btn btn-primary">
                <i class="bi bi-info-circle-fill"></i> Info Terbaru</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Chart Container -->
    <div class="chart-container">
      <canvas id="myChart"></canvas>
    </div>
  </div>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script>
    function getData() {
      $.ajax({
        type: "GET",
        url: "getData.php",
        success: function(response) {
          console.log("Response from getData.php:", response); // Debugging
          const totalLaporan = response.totalLaporan;
          const totalLaporanSelesai = response.totalLaporanSelesai;

          const ctx = document.getElementById('myChart').getContext('2d');
          new Chart(ctx, {
            type: 'pie',
            data: {
              labels: ['Total Laporan', 'Total Laporan Selesai'],
              datasets: [{
                label: 'Jumlah',
                data: [totalLaporan, totalLaporanSelesai],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1,
              }],
            },
            options: {
              responsive: true,
              plugins: {
                legend: {
                  position: 'top',
                },
                title: {
                  display: true,
                  text: 'Chart Total Laporan dan Laporan Selesai',
                },
              },
            },
          });
        },
        error: function(xhr, status, error) {
          console.error("Error fetching data:", error);
        }
      });
    }
  </script>
</body>

</html>