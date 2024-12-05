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
      margin-top: 20px;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
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
    <h1>Dashboard</h1>
    <div class="welcome-container">
      <p>Selamat Datang Dosen</p>
      <div class="divider"></div>
      <p>Sistem Tata Tertib</p>
    </div>

    <center>
      <h4>Pengajuan Banding dari Mahasiswa</h4>
    </center>
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
        <?php
        include "koneksi.php";
        $user_id = $_COOKIE["user_id"];
        
        $query = "SELECT m.nama, p.pelanggaran, p.sanksi, ab.alasan, ab.status
                  FROM aju_banding AS ab
                  JOIN pelanggaran p ON ab.pelaporan_id = p.pelanggar_id
                  JOIN mahasiswa m ON p.pelanggar_id = m.pelanggar_id
                  WHERE ab.user_id = ?";
        
        $params = array($user_id);
        $stmt = sqlsrv_prepare($conn, $query, $params);
        
        if ($stmt === false) {
          die(print_r(sqlsrv_errors(), true));
        }
        
        if (sqlsrv_execute($stmt)) {
          $no = 1;
          while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row["nama"]; ?></td>
              <td><?php echo $row["pelanggaran"]; ?></td>
              <td><?php echo $row["sanksi"]; ?></td>
              <td><?php echo $row["alasan"]; ?></td>
              <td>
                <?php 
                if ($row["status"] == "Tolak") {
                  echo "<span class='badge badge-danger'>Dilaporkan</span>";
                } else if ($row["status"] == "Terima") {
                  echo "<span class='badge badge-warning'>Dilakukan</span>";
                }
                ?>
              </td>
            </tr>
            <?php
          }
        } else {
          echo "Error executing query.";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>