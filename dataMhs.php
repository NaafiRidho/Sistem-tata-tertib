<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Si Tertib - Data Mahasiswa">
  <meta name="keywords" content="Data Mahasiswa, Teknologi Informasi">
  <title>Data Mahasiswa - Teknologi Informasi</title>
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

    .menu a:hover,
    .menu a.active {
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

    th,
    td {
      text-align: center;
      padding: 10px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn-edit {
      background-color: #007bff;
      color: white;
    }

    .btn-edit:hover {
      background-color: #0056b3;
    }

    .btn-delete {
      background-color: #d9534f;
      color: white;
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

    .btn-delete:hover {
      background-color: #c9302c;
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
      <a href="dataMhs.php" class="active"><i class="bi bi-person"></i> Data Mahasiswa</a>
      <a href="dataDosen.php"><i class="bi bi-person-badge"></i> Data Dosen</a>
      <a href="#pelanggaranMahasiswa"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
    </div>
    <div class="logout">
      <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <div class="content">
    <h1 class="header-title">Data Mahasiswa</h1>
    <div class="table-container">
      <div class="search-bar">
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalForm">+ Tambah Data Baru</button>
      </div>
      <table id="example" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi</th>
            <th>Kelas</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "koneksi.php";

          $options = array("Scrollable" => SQLSRV_CURSOR_STATIC);
          $query = "SELECT m.nim, m.nama, k.prodi, k.nama_kelas, m.mahasiswa_id FROM mahasiswa AS m
                    INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id";
          $result = sqlsrv_query($conn, $query, array(), $options);

          if (sqlsrv_num_rows($result) > 0) {
            $no = 1;
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
          ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nim'] ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['prodi'] ?></td>
                <td><?php echo $row['nama_kelas'] ?></td>
                <td>
                  <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#modalEdit"
                    data-mahasiswa_id="<?php echo $row['mahasiswa_id'] ?>">Edit</button>
                  <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#modalHapus"
                    data-mahasiswa_id="<?php echo $row['mahasiswa_id'] ?>">Hapus</button>
                </td>
              </tr><?php
                  }
                }
                    ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Modal Tambah/Edit Data -->
  <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">Tambah Data Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formMahasiswa">
            <div class="mb-3">
              <label for="nim" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username"
                placeholder="Masukkan User Name Untuk Mahasiswa" required>
            </div>
            <div class="mb-3">
              <label for="nim" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password"
                placeholder="Masukkan Password Untuk Mahasiswa" required>
            </div>
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Mahasiswa</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Mahasiswa"
                required>
            </div>
            <div class="form-group">
              <label for="prodi" class="required">Program Studi</label>
              <select class="form-control prodi" required>
                <option value="" disabled selected>Pilih Program Studi</option>
                <?php
                include 'koneksi.php'; // File koneksi ke SQL Server

                $query = "SELECT DISTINCT prodi FROM kelas ORDER BY prodi"; // Query SQL
                $result = sqlsrv_query($conn, $query); // Eksekusi query dengan sqlsrv_query

                if ($result === false) {
                  die(print_r(sqlsrv_errors(), true)); // Menampilkan error jika query gagal
                }

                // Menampilkan setiap prodi sebagai elemen <option>
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['prodi']) . '">' . htmlspecialchars($row['prodi']) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="kelas" class="required">Kelas</label>
              <select id="kelas" class="form-control" required>
                <option value="" disabled selected>Pilih Kelas</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="saveData">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalFormEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">Edit Data Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="form-group">
              <label for="nama" class="form-label">Nama Mahasiswa</label>
              <input type="text" id="namaMhs" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="nim" class="form-label">NIM Mahasiswa</label>
              <input type="text" id="nimMhs" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="prodi" class="required">Program Studi</label>
              <select id="prodiMhs" class="form-control prodi" required>
                <option value="" disabled selected>Pilih Program Studi</option>
                <?php
                include 'koneksi.php'; // File koneksi ke SQL Server

                $query = "SELECT DISTINCT prodi FROM kelas ORDER BY prodi"; // Query SQL
                $result = sqlsrv_query($conn, $query); // Eksekusi query dengan sqlsrv_query

                if ($result === false) {
                  die(print_r(sqlsrv_errors(), true)); // Menampilkan error jika query gagal
                }

                // Menampilkan setiap prodi sebagai elemen <option>
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['prodi']) . '">' . htmlspecialchars($row['prodi']) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="kelas" class="required">Kelas</label>
              <select id="kelasMhs" class="form-control" required>
                <option value="" disabled selected>Pilih Kelas</option>
              </select>
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

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalFormEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFormLabel">Hapus Data Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Ingin Menghapus Mahasiswa</p>
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

      // Event untuk dropdown prodi di modal tambah
      $(document).on('change', '.prodi', function() {
        const prodi = $(this).val(); // Ambil nilai dari dropdown prodi
        const kelasDropdown = $('#kelas'); // Dropdown kelas

        // Bersihkan dropdown kelas dan tampilkan opsi placeholder
        kelasDropdown.empty().append('<option value="" disabled selected>Memuat Kelas...</option>');

        // AJAX request untuk memuat kelas berdasarkan prodi
        $.ajax({
          url: 'get_kelas.php',
          method: 'GET',
          data: {
            prodi: prodi
          },
          dataType: 'json',
          success: function(data) {
            console.log(data); // Debugging
            kelasDropdown.empty().append('<option value="" disabled selected>Pilih Kelas</option>');
            $.each(data, function(index, kelas) {
              kelasDropdown.append('<option value="' + kelas.nama_kelas + '">' + kelas.nama_kelas + '</option>');
            });
          },
          error: function() {
            kelasDropdown.empty().append('<option value="" disabled selected>Error memuat kelas</option>');
          }
        });
      });

      $(document).on('click', '.btn-edit', function() {
        var mahasiswa_id = $(this).data('mahasiswa_id'); // Ambil ID mahasiswa dari data attribute
        $("#modalEdit").data('mahasiswa_id', mahasiswa_id);

        $.ajax({
          url: "getMhs.php", // Pastikan URL ini benar
          method: "GET",
          data: {
            mahasiswa_id: mahasiswa_id
          },
          dataType: "JSON",
          success: function(data) {
            // Isi form di modal edit dengan data yang diterima
            $('#namaMhs').val(data.nama);
            $("#nimMhs").val(data.nim);
            $("#prodiMhs").val(data.prodi).trigger('change');
            $('#kelasMhs').val(data.nama_kelas);
            setTimeout(function() {
              $('#kelasMhs').val(data.nama_kelas);
            }, 500);
          },
          error: function(xhr, status, error) {
            console.error("Error: ", xhr.responseText);
            alert("Terjadi kesalahan saat mengambil data mahasiswa.");
          }
        });
      });
      // Event untuk dropdown prodi di modal edit
      $(document).on('change', '#modalEdit .prodi', function() {
        const prodi = $(this).val(); // Ambil nilai dari dropdown prodi
        const kelasDropdown = $('#modalEdit #kelasMhs'); // Dropdown kelas di modal edit

        // Bersihkan dropdown kelas dan tampilkan opsi placeholder
        kelasDropdown.empty().append('<option value="" disabled selected>Memuat Kelas...</option>');

        // AJAX request untuk memuat kelas berdasarkan prodi
        $.ajax({
          url: 'get_kelas.php',
          method: 'GET',
          data: {
            prodi: prodi
          },
          dataType: 'json',
          success: function(data) {
            console.log(data); // Debugging
            kelasDropdown.empty().append('<option value="" disabled selected>Pilih Kelas</option>');
            $.each(data, function(index, kelas) {
              kelasDropdown.append('<option value="' + kelas.nama_kelas + '">' + kelas.nama_kelas + '</option>');
            });
          },
          error: function() {
            kelasDropdown.empty().append('<option value="" disabled selected>Error memuat kelas</option>');
          }
        });
      });

      $("#saveData").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        var nim = $("#nim").val();
        var nama = $("#nama").val();
        var prodi = $(".prodi").val();
        var kelas = $("#kelas").val();

        console.log("AJAX request sent"); // Debugging

        $.ajax({
          url: "tambahMhs.php",
          method: "POST",
          dataType: "JSON",
          data: {
            username: username,
            password: password,
            nim: nim,
            nama: nama,
            prodi: prodi,
            kelas: kelas
          },
          success: function(response) {
            console.log(response); // Debugging
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
      $(document).on('click', '#saveEdit', function() {
        // Ambil data dari modal edit
        var nim = $("#nimMhs").val();
        var nama = $("#namaMhs").val();
        var prodi = $("#prodiMhs").val();
        var kelas = $("#kelasMhs").val();
        var mahasiswa_id = $("#modalEdit").data('mahasiswa_id');

        // Validasi data sebelum dikirim
        if (!nim || !nama || !prodi || !kelas) {
          alert("Harap lengkapi semua data sebelum menyimpan!");
          return;
        }

        $.ajax({
          url: "editMhs.php",
          method: "POST",
          data: {
            mahasiswa_id: mahasiswa_id,
            nim: nim,
            nama: nama,
            prodi: prodi,
            kelas: kelas
          },
          dataType: "JSON",
          success: function(response) {
            // Cek respon dari server
            if (response.status === "success") {
              alert(response.message);
              $("#modalEdit").modal("hide");
              location.reload();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function(xhr, status, error) {
            // Tampilkan pesan error jika AJAX gagal
            console.error("Error: ", xhr.responseText);
            alert("Terjadi kesalahan saat mengirim data ke server.");
          }
        });
      });

      $(document).on("click", ".btn-delete", function() {
        var mahasiswa_id = $(this).data('mahasiswa_id');
        $("#modalHapus").data('mahasiswa_id', mahasiswa_id);
      });

      $(document).on("click", "#saveHapus", function() {
        var mahasiswa_id = $("#modalHapus").data('mahasiswa_id');
        $.ajax({
          url: "hapusMhs.php",
          method: "POST",
          data: {
            mahasiswa_id: mahasiswa_id
          },
          dataType: "JSON",
          success: function(response) {
            if (response.status === "success") {
              alert(response.message);
              $("#modalHapus").modal("hide");
              location.reload();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function(xhr, status, error) {
            // Tampilkan pesan error jika AJAX gagal
            console.error("Error: ", xhr.responseText);
            alert("Terjadi kesalahan saat mengirim data ke server.");
          }
        });
      });
    });
  </script>
</body>

</html>