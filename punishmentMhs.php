<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punishment - Si Tertib</title>
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
            transition: all 0.3s ease;
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
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 15px;
            font-size: 1rem;
            text-decoration: none;
            background-color: #d9534f;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #c9302c;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
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

        .btn-cetak-surat {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-cetak-surat:hover {
            background-color: #218838;
        }

        /* Custom button style for file input */
        .btn-upload-label {
            margin-top: 30px;
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-upload-label:hover {
            background-color: #218838;
        }

        /* Hide the default file input */
        input[type="file"] {
            display: none;
        }
    </style>
</head>

<body>

    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu">
            <h2>Si Tertib</h2>
            <a href="dashboardMhs.php">
                <i class="bi bi-columns-gap"></i> <span>Dashboard</span>
            </a>
            <a href="laporanMhs.php">
                <i class="bi bi-file-text"></i> <span>Laporan</span>
            </a>
            <a href="punishmentMhs.php" class="active">
                <i class="bi bi-exclamation-circle"></i> <span>Punishment</span>
            </a>
            <a href="history_pelanggaran.php">
                <i class="bi bi-clock-history"></i> <span>History Pelanggaran</span>
            </a>
        </div>
        <div class="logout">
            <a href="login.php">
                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Punishment</h2>
        <form action="suratPunishment.php">
            <button class="btn-cetak-surat btn btn-primary">
                <i class="bi bi-printer"></i> Cetak Surat
            </button>
        </form>
        <!-- Form untuk mengunggah file -->
        <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3 ">
                <label for="fileUpload" class="btn-upload-label">
                    <i class="bi bi-upload" style="margin-right: 10px;"></i>Upload File</label>
                <input type="file" class="form-control" id="fileUpload" name="uploadedFile" required>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-cloud-arrow-up" style="margin-right: 10px;"></i> Unggah
            </button>
        </form>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('close');
            document.querySelector('.content').classList.toggle('shift');
        }
    </script>
</body>

</html>