<?php
include 'koneksi.php';

header('Content-Type: application/json'); // Pastikan respons adalah JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data POST
    $nama = $_POST['nama'] ?? null;
    $nim = $_POST['nim'] ?? null;
    $prodi = $_POST['prodi'] ?? null;
    $kelas = $_POST['kelas'] ?? null;
    $pelanggaran = $_POST['pelanggaran'] ?? null;
    $sanksi = $_POST['sanksi'] ?? null;
    $tanggal = $_POST['tanggal'] ?? null;

    // Validasi data
    if (!$nama || !$nim || !$prodi || !$kelas || !$pelanggaran || !$sanksi || !$tanggal) {
        echo json_encode(["status" => "error", "message" => "Semua data wajib diisi."]);
        exit;
    }

    // Lokasi upload file
    $uploadDir = 'pelanggaran/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    
    $targetFile = null;
    if (isset($_FILES['upload-bukti']) && $_FILES['upload-bukti']['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['upload-bukti']['name']);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (in_array($fileType, $allowedExtensions)) {
            $targetFile = $uploadDir . $fileName;
            if (!move_uploaded_file($_FILES['upload-bukti']['tmp_name'], $targetFile)) {
                echo json_encode(["status" => "error", "message" => "Gagal mengunggah file."]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Ekstensi file tidak diizinkan."]);
            exit;
        }
    }

    // Cari `dosen_id`
    $user_id = $_COOKIE['user_id']; // Ambil dari session login
    $query = "SELECT dosen_id FROM dosen WHERE user_id = ?";
    $stmt = sqlsrv_query($conn, $query, [$user_id]);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
        exit;
    }
    $dosen_id = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)['dosen_id'];

    // Cari `mahasiswa_id`
    $query = "SELECT mahasiswa_id FROM mahasiswa WHERE nim = ?";
    $stmt = sqlsrv_query($conn, $query, [$nim]);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
        exit;
    }
    $mahasiswa_id = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)['mahasiswa_id'];

    // Cari `pelanggaran_id` dan `tingkat_id`
    $query = "SELECT pelanggaran_id, tingkat_id FROM pelanggaran WHERE pelanggaran = ?";
    $stmt = sqlsrv_query($conn, $query, [$pelanggaran]);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
        exit;
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $pelanggaran_id = $row['pelanggaran_id'];
    $tingkat_id = $row['tingkat_id'];

    // Simpan ke tabel `riwayat_pelaporan`
    $query = "INSERT INTO riwayat_pelaporan (dosen_id, mahasiswa_id, pelanggaran_id, tingkat_id, tanggal, status, [file])
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [$dosen_id, $mahasiswa_id, $pelanggaran_id, $tingkat_id, $tanggal, 'Dilaporkan', $targetFile];
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt) {
        echo json_encode(["status" => "success", "message" => "Laporan berhasil disimpan."]);
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
}
