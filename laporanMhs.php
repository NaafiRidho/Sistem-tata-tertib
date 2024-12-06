<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Si Tertib</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!--JQUERY-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!--Data Table -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
      transition: transform 0.3s ease;
    }

    .sidebar h2 {
      text-align: center;
      margin: 20px 0;
      font-size: 1.5rem;
    }

    .sidebar.close {
      transform: translateX(-100%);
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

    .menu a.active {
      background-color: #0056b3;
      border-left: 5px solid #ffcc00;
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
      transition: margin-left 0.3s ease;
    }

    .content.shift {
      margin-left: 40px;
    }

    .toggle-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: #002a8a;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      z-index: 100;
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
      width: 100px;
      text-align: center;
    }

    .btn-detail:hover {
      background-color: #0056b3;
    }

    td .btn-success {
      margin-bottom: 10px;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      text-decoration: none;
      width: 100px;
      text-align: center;
    }

    .dataTables_paginate {
      float: right !important;
    }

    .dataTables_filter {
      float: right !important;
    }

    .table img {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    button:disabled {
      background-color: #ccc;
      color: #666;
      cursor: not-allowed;
      border-color: #aaa;
    }

    .form-control {
      white-space: normal;
      word-wrap: break-word;
      overflow-wrap: break-word;
      height: auto;
    }
  </style>
</head>

<body>

  <button class="toggle-btn" onclick="toggleSidebar()">☰</button>


  <div class="sidebar">
    <div class="menu">
      <h2>Si Tertib</h2>
      <a href="dashboardMhs.php">
        <i class="bi bi-columns-gap"></i> <span>Dashboard</span>
      </a>
      <a href="laporanMhs.php" class="active">
        <i class="bi bi-file-text"></i> <span>Laporan</span>
      </a>
      <a href="punishmentMhs.php">
        <i class="bi bi-exclamation-circle"></i> <span>Punishment</span>
      </a>
      <a href="history_pelanggaran.php">
        <i class="bi bi-clock-history"></i> <span>History Pelanggaran</span>
      </a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span>
      </a>
    </div>
  </div>


  <div class="content">
    <h2>Laporan</h2>
    <div class="card">
      <div class="card-header">
        Laporan Dari Dosen
      </div>
      <div class="card-body">
        <table id="example" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Dosen Pelapor</th>
              <th>Pelanggaran</th>
              <th>Tingkat</th>
              <th>Tanggal</th>
              <th>Sanksi</th>
              <th>Bukti</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "koneksi.php";

            $user_id = $_COOKIE["user_id"];


            $query = "SELECT d.nama, pl.pelanggaran, t.tingkat, CONVERT(date, p.tanggal) AS tanggal,t.sanksi,
            p.[file],m.nim,m.nama as mahasiswa, p.pelaporan_id, k.prodi, p.status
            FROM dbo.riwayat_pelaporan AS p
            INNER JOIN dbo.mahasiswa AS m ON p.mahasiswa_id = m.mahasiswa_id
            INNER JOIN dbo.kelas AS k ON k.kelas_id = m.kelas_id
            INNER JOIN dbo.[user] AS u ON u.user_id = m.user_id
            INNER JOIN dbo.dosen AS d ON d.dosen_id = p.dosen_id
            INNER JOIN dbo.tingkat AS t ON p.tingkat_id = t.tingkat_id
            INNER JOIN dbo.pelanggaran pl ON pl.pelanggaran_id = p.pelanggaran_id
            WHERE u.user_id = ?";


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
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $row["nama"] ?></td>
                  <td><?php echo $row["pelanggaran"] ?></td>
                  <td><?php echo $row["tingkat"] ?></td>
                  <td><?php echo $row["tanggal"]->format('Y-m-d') ?></td>
                  <td><?php echo $row["sanksi"] ?></td>
                  <td>
                    <?php $file = $row["file"]; ?>
                    <img src="<?php echo $file; ?>" alt="Bukti" class="mb-2">
                  </td>
                  <td>
                    <?php
                    if ($row['status'] !== 'Diterima') {
                      ?><button class="btn-success" data-bs-toggle="modal" data-bs-target="#modalTerima"
                        data-pelaporan_id="<?php echo $row['pelaporan_id']; ?>">
                        Terima</button><?php
                    } else {
                      ?><button class="btn-success" disabled>
                        Diterima
                      </button><?php
                    }
                    ?>
                    <button class="btn-detail" data-bs-toggle="modal" data-bs-target="#modalUlasan"
                      data-pelanggaran="<?php echo $row['pelanggaran']; ?>" data-nama="<?php echo $row['mahasiswa']; ?>"
                      data-nim="<?php echo $row['nim']; ?>" data-file="<?php echo $row['file']; ?>"
                      data-pelaporan_id="<?php echo $row['pelaporan_id']; ?>" data-prodi="<?php echo $row['prodi']; ?>">
                      Banding
                    </button>
                  </td>
                </tr>
                <?php
              }
            } else {
              die(print_r(sqlsrv_errors(), true));
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--Modal Terima-->
  <div class="modal fade" id="modalTerima" tabindex="-1" aria-labelledby="modalTerimaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTerimaLabel">Terima Pelanggaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda Ingin Menerima Pelanggaran Yang Dilaporkan
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="btnTerima">Terima</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Banding -->
  <div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUlasanLabel">Detail Pelanggaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="Noufal Fakhri" readonly>
          </div>
          <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" readonly>
          </div>
          <div class="mb-3">
            <label for="pelanggaran" class="form-label">Pelanggaran</label>
            <textarea class="form-control" id="pelanggaran" rows="3"
              readonly><?php echo $row['pelanggaran']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <div class="text-center">
              <img src="<?php echo $file; ?>" id="foto" alt="Foto Pelanggaran" class="img-fluid"
                style="width: 150px; height: auto; object-fit: cover;">
            </div>
          </div>
          <div class="mb-3">
            <label for="ajubanding" class="form-label">Ajukan Banding</label>
            <textarea class="form-control" id="ajubanding" rows="3"
              placeholder="Tuliskan alasan banding Anda..."></textarea>
          </div>

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
  <script type="text/javascript">
    $(document).ready(function () {
      // Inisialisasi DataTable
      $('#example').DataTable();

      $('.btn-success').click(function () {
        var pelaporan_id = $(this).data('pelaporan_id');
        $("#modalTerima").data('pelaporan_id', pelaporan_id);
      });

      $('#btnTerima').click(function () {
        var pelaporan_id = $("#modalTerima").data('pelaporan_id');
        if (confirm("Apakah Anda yakin ingin menerima laporan ini?")) {
          $.ajax({
            url: 'terima_laporan.php', // File PHP yang akan memproses query
            type: 'POST',
            data: {
              pelaporan_id: pelaporan_id
            },
            success: function (response) {
              alert('Laporan berhasil diterima!');
              $('#modalTerima').modal('hide');
            },
            error: function (xhr, status, error) {
              alert('Terjadi kesalahan: ' + error);
            }
          });
        }
      });

      // Ketika tombol 'Lihat Detail' diklik
      $('.btn-detail').click(function () {
        // Ambil data yang disimpan dalam atribut data-*
        var pelanggaran = $(this).data('pelanggaran');
        var nama = $(this).data('nama');
        var nim = $(this).data('nim');
        var file = $(this).data('file');
        var pelaporan_id = $(this).data('pelaporan_id');
        var prodi = $(this).data('prodi');

        // Masukkan data ke dalam modal
        $('#pelanggaran').val(pelanggaran);
        $('#nama').val(nama);
        $('#nim').val(nim);
        $('#foto').attr('src', file); // Foto
        $('#modalUlasan').data('pelaporan_id', pelaporan_id); //menyimpan id pelaporan ke dalam modal
        $('#modalUlasan').data('prodi', prodi); //menyimpan prodi
      });

      $('#btnKirim').click(function () {
        var pelaporanId = $('#modalUlasan').data('pelaporan_id'); // Ambil pelaporan_id dari modal
        var alasanBanding = $('#ajubanding').val(); // Ambil alasan banding
        var prodi = $('#modalUlasan').data('prodi'); // Ambil prodi

        $.ajax({
          url: 'aju_banding.php',
          type: 'post',
          data: {
            pelaporan_id: pelaporanId,
            alasan_banding: alasanBanding,
            prodi: prodi
          },
          success: function (response) {
            alert('Alasan Banding berhasil dikirim');
            $('#modalUlasan').modal('hide');
          },
          error: function (xhr, status, error) {
            alert('Error: ' + error);
          }
        })
      })
    });
  </script>
  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('close');
      document.querySelector('.content').classList.toggle('shift');
    }
  </script>

</body>

</html>