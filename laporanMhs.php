<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Si Tertib</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .table img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
    }

    .btn-detail {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn-detail:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="menu">
    <h2>Si Tertib</h2>
    <a href="dashboardMhs.php"><i class="bi bi-house"></i> Dashboard</a>
    <a href="laporanMhs.php" class="active"><i class="bi bi-file-text"></i> Laporan</a>
    <a href="#punishment"><i class="bi bi-gavel"></i> Punishment</a>
    <a href="#history"><i class="bi bi-clock-history"></i> History Pelanggaran</a>
  </div>
  <div class="logout">
    <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>


<div class="content">
  <h2>Laporan</h2>
  <div class="card">
    <div class="card-header">
      Laporan Dari Dosen
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Dosen Pelapor</th>
            <th>Pelanggaran</th>
            <th>Tingkat</th>
            <th>Tanggal</th>
            <th>Sanksi</th>
            <th>Bukti</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Ekojono, ST., M.Kom</td>
            <td>Merokok di luar area kawasan merokok</td>
            <td>III</td>
            <td>19/11/2023</td>
            <td>Membuat surat pernyataan tidak mengulangi perbuatan tersebut, ditandatangani mahasiswa yang bersangkutan dan DPA.</td>
            <td>
              <img src="bukti1.jpg" alt="Bukti">
              <br>
              <button class="btn-detail" data-bs-toggle="modal" data-bs-target="#modalUlasan">Lihat Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUlasanLabel">Isi Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" rows="4" placeholder="Tulis ulasan Anda..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btnKirim">Kirim</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('btnKirim').addEventListener('click', function () {
    alert('Ulasan berhasil dikirim');
  });
</script>
</body>
</html>