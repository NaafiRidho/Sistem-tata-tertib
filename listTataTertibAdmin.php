<?php
$columns = [
    'pelanggaran' => 'Nama Pelanggaran',
    'tingkat' => 'Tingkat',
    'sanksi' => 'Sanksi',
];

$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT p.pelanggaran_id, p.pelanggaran, t.tingkat, t.sanksi
          FROM pelanggaran p
          JOIN tingkat t ON p.tingkat_id = t.tingkat_id";

if (!empty($searchKeyword)) {
    $query .= " WHERE p.pelanggaran LIKE '%$searchKeyword%' 
                OR t.tingkat LIKE '%$searchKeyword%' 
                OR t.sanksi LIKE '%$searchKeyword%'";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tata Tertib</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
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

        .search-box {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-box input {
            width: 200px;
            height: 40px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-box button {
            background-color: transparent;
            border: none;
            color: #007bff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .search-box button:hover {
            color: #0056b3;
        }

        .btn-tambah {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: white !important;
            width: 200px;
            height: 40px;
            border-radius: 5px;
        }

        .btn-tambah:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }

        .table td button.btn-danger {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardAdmin.php"><i class="bi bi-columns-gap"></i> Dashboard</a>
            <a href="listTataTertibAdmin.php" class="active"><i class="bi bi-list-check"></i> List Tata Tertib</a>
            <a href="#dataMahasiswa"><i class="bi bi-person"></i> Data Mahasiswa</a>
            <a href="#dataDosen"><i class="bi bi-person-badge"></i> Data Dosen</a>
            <a href="#pelanggaranMahasiswa"><i class="bi bi-exclamation-circle"></i> Pelanggaran Mahasiswa</a>
        </div>
        <div class="logout">
            <a href="login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <h2>List Tata Tertib</h2>
        <div class="card">
            <div class="card-header">List Peraturan dan Tata Tertib Jurusan Teknologi Informasi</div>
            <div class="card-body mt-3">
                <!-- Search Box and Add Rule Button -->
                <div class="search-box d-flex justify-content-between align-items-center">
                    <button class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalAddRule">
                        <i class="bi bi-plus-circle"></i> Peraturan Baru</button>

                    <form method="GET" action="listTataTertibAdmin.php" class="d-flex">
                        <input type="text" name="search" placeholder="Search Keyword"
                            value="<?php echo htmlspecialchars($searchKeyword); ?>" />
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <!-- Table to Display Data -->
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

                        // Menjalankan query pencarian
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
                                        data-bs-target="#modalEdit"
                                        data-pelanggaran_id="<?php echo $row['pelanggaran_id']; ?>">Edit</button>
                                    <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#modalHapus"
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

    <!-- Modal for Adding New Rule -->
    <div class="modal fade" id="modalAddRule" tabindex="-1" aria-labelledby="modalAddRuleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddRuleLabel">Tambah Peraturan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_rule.php" method="POST">
                        <div class="mb-3">
                            <label for="pelanggaran" class="form-label">Nama Pelanggaran</label>
                            <input type="text" class="form-control" id="pelanggaran" name="pelanggaran" required>
                        </div>
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <input type="text" class="form-control" id="tingkat" name="tingkat" required>
                        </div>
                        <div class="mb-3">
                            <label for="sanksi" class="form-label">Sanksi</label>
                            <input type="text" class="form-control" id="sanksi" name="sanksi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function()) {
    $('#example').DataTable();
    }
/script>
</body>

</html>
