<?php
// Array kolom yang ingin ditampilkan
$columns = [
    'pelanggaran' => 'Nama Pelanggaran',
    'tingkat' => 'Tingkat',
    'sanksi' => 'Sanksi',
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tata Tertib</title>
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
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="#dashboard"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="listTataTertibAdmin.php" class="active"><i class="bi bi-list-check"></i> List Tata Tertib</a>
            <a href="#dataMahasiswa"><i class="bi bi-person"></i> Data Mahasiswa</a>
            <a href="#dataDosen"><i class="bi bi-person-badge"></i> Data Dosen</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h2>List Tata Tertib</h2>
        <div class="card">
            <div class="card-header">Pengajuan Banding Dari Mahasiswa</div>
            <div class="card-body mt-3">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <?php foreach ($columns as $col => $label): ?>
                                <th><?php echo htmlspecialchars($label); ?></th>
                            <?php endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";

                        $query = "SELECT p.pelanggaran_id, p.pelanggaran, t.tingkat, t.sanksi
                                  FROM pelanggaran p
                                  JOIN tingkat t ON p.tingkat_id = t.tingkat_id";

                        $stmt = sqlsrv_query($conn, $query);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        $no = 1;
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <?php foreach ($columns as $col => $label): ?>
                                    <td><?php echo htmlspecialchars($row[$col]); ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalTerima"
                                        data-pelanggaran_id="<?php echo $row['pelanggaran_id']; ?>">Edit</button>
                                    <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#modalTolak"
                                        data-pelanggaran_id="<?php echo $row['pelanggaran_id']; ?>">Hapus</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>