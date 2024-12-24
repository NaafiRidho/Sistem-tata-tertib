<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Si Tertib - Data Dosen">
  <meta name="keywords" content="Data Dosen, Si Tertib">
  <title>Data Dosen</title>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .sidebar h2 {
      text-align: center;
      color: white;
      margin: 20px 0;
      font-size: 2rem;
      font-family: 'Fugaz One', sans-serif;
      font-weight: 600;
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

    .table-container {
      margin: 20px auto;
      padding: 20px;
      width: 100%;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    .btn-edit {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-edit:hover {
      background-color: #0056b3;
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

    .search-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .search-bar input {
      width: 250px;
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      text-align: center;
      padding: 10px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .sidebar img {
      display: block;
      margin: 20px auto;
      border-radius: 30%;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
      font-size: 0.9rem;
    }

    .entries-info {
      color: #666;
    }

    .pagination {
      margin: 0;
    }

    .dataTables_paginate {
      float: right !important;
    }

    .dataTables_filter {
      float: right !important;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <div class="menu">
      <img src="logo.png" style="width: 120px; height: 120px;">
      <h2>Si Tertib</h2>
      <a href="dashboardAdmin.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
      <a href="listTataTertibAdmin.php"><i class="bi bi-list-check"></i> List Tata Tertib</a>
      <a href="listSanksiAdmin.php"><i class="bi bi-list-check"></i> List Sanksi</a>
      <a href="dataMhs.php"><i class="bi bi-person"></i> Data Mahasiswa</a>
      <a href="dataDosen.php" class="active"><i class="bi bi-person-badge"></i> Data Dosen</a>
      <a href="laporanAdmin.php"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <h1>Data Dosen</h1>
    <div class="table-container">
      <div class="search-bar">
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalForm">+ Tambah Data Baru</button>
      </div>
      <table id="example" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "koneksi.php";
          require_once 'Database.php';

          $db = new Database($conn);
          $query = "SELECT d.nama, d.nidn, d.dosen_id FROM dosen AS d
                    INNER JOIN [user] AS u ON u.user_id = d.user_id";
          $stmt = $db->executeQuery($query);
          $no = 1;
          while ($row = $db->fetchAssoc($stmt)) { ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $row['nidn'] ?></td>
              <td><?php echo $row['nama'] ?></td>
              <td>
                <button class='btn-edit' data-bs-toggle="modal" data-bs-target="#modalEdit" data-dosen_id="<?php echo $row['dosen_id'] ?>">Edit</button>
                <button class='btn-delete' data-bs-toggle="modal" data-bs-target="#modalHapus" data-dosen_id="<?php echo $row['dosen_id'] ?>">Hapus</button>
              </td>
            </tr><?php
                }
                  ?>
        </tbody>
      </table>

      <!--Modal Tambah Dosen-->
      <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalFormLabel">Tambah Data Dosen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group">
                  <label for="nama" class="form-label">Username Dosen</label>
                  <input type="text" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">Password Dosen</label>
                  <input type="text" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">Nama Dosen</label>
                  <input type="text" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">NIDN Dosen</label>
                  <input type="text" id="nidn" class="form-control" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" id="save">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <!--Modal Edit Dosen-->
      <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalFormLabel">Edit Data Dosen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group">
                  <label for="nama" class="form-label">Username Dosen</label>
                  <input type="text" id="usernameEdit" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">Password Dosen</label>
                  <input type="text" id="passwordEdit" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">Nama Dosen</label>
                  <input type="text" id="namaEdit" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama" class="form-label">NIDN Dosen</label>
                  <input type="text" id="nidnEdit" class="form-control" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" id="saveEdit">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Hapus Data -->
      <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalFormEdit" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalFormLabel">Hapus Data Dosen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Apakah Ingin Menghapus Dosen</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger" id="saveHapus">Hapus</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <!-- DataTables JS -->
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#example').DataTable();

          $(document).on('click', '#save', function() {
            var username = $("#username").val();
            var password = $("#password").val();
            var nama = $("#nama").val();
            var nidn = $("#nidn").val();

            $.ajax({
              url: "tambahDosen.php",
              method: "POST",
              dataType: "JSON",
              data: {
                username: username,
                password: password,
                nama: nama,
                nidn: nidn
              },
              success: function(response) {
                if (response.status === "success") {
                  alert(response.message);
                  $("#modalForm").modal("hide");
                  location.reload();
                } else {
                  alert("Error: " + response.message);
                }
              },
              error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert("Terjadi kesalahan saat mengirim data ke server.");
              }
            });
          });

          $(document).on('click', '.btn-edit', function() {
            var dosen_id = $(this).data('dosen_id');
            $("#modalEdit").data('dosen_id', dosen_id);

            $.ajax({
              url: "getDosen.php",
              method: "GET",
              dataType: "JSON",
              data: {
                dosen_id: dosen_id
              },
              success: function(data) {
                $("#namaEdit").val(data.nama);
                $("#nidnEdit").val(data.nidn);
                $("#usernameEdit").val(data.username);
                $("#passwordEdit").val(data.password);
              },
              error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert("Terjadi kesalahan saat mengirim data ke server.");
              }
            });
          });

          $(document).on('click', '#saveEdit', function() {
            var nama = $("#namaEdit").val();
            var nidn = $("#nidnEdit").val();
            var username = $("#usernameEdit").val();
            var password = $("#passwordEdit").val();
            var dosen_id = $("#modalEdit").data('dosen_id')

            $.ajax({
              url: "editDosen.php",
              method: "POST",
              dataType: "JSON",
              data: {
                nama: nama,
                nidn: nidn,
                dosen_id: dosen_id,
                username: username,
                password: password
              },
              success: function(response) {
                if (response.status === "success") {
                  alert(response.message);
                  $("#modalEdit").modal("hide");
                  location.reload();
                }
              },
              error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert("Terjadi kesalahan saat mengirim data ke server.");
              }
            });
          });

          $(document).on('click', '.btn-delete', function() {
            var dosen_id = $(this).data('dosen_id');
            $("#modalHapus").data('dosen_id', dosen_id);
          });


          $(document).on('click', '#saveHapus', function() {
            var dosen_id = $('#modalHapus').data('dosen_id');

            $.ajax({
              url: "hapusDosen.php",
              method: "POST",
              dataType: "JSON",
              data: {
                dosen_id: dosen_id
              },
              success: function(response) {
                alert(response.message);
                location.reload();
              },
              error: function(xhr, status, error) {
                console.error("Error: ", xhr.responseText);
                alert("Terjadi kesalahan saat mengirim data ke server.");
              }
            });

          });
        });
      </script>
</body>

</html>