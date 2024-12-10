<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$prodi = $_POST['prodi'];
$kelas = $_POST['kelas'];

// Debugging: Tampilkan data yang diterima
error_log("Data received: " . json_encode($_POST));

$query = "INSERT INTO [user] VALUES (?,?,?)";
$params = array($username, $password, "Mahasiswa");
$stmt = sqlsrv_query($conn, $query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit; // Pastikan untuk keluar setelah mengirim respons error
}


// Lanjutkan dengan sisa kode...
$query = "SELECT user_id FROM [user] WHERE username = ?";
$stmt = sqlsrv_query($conn, $query, [$username]);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$user_id = $row['user_id'];

$query = "SELECT kelas_id FROM kelas WHERE prodi = ? AND nama_kelas= ?";
$params = array($prodi, $kelas);
$stmt = sqlsrv_query($conn, $query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$kelas_id = $row['kelas_id'];

$query = "INSERT INTO mahasiswa VALUES (?,?,?,?)";
$params = array($user_id, $kelas_id, $nama, $nim);
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt) {
    // Hanya satu respons JSON
    echo json_encode(["status" => "success", "message" => "Data Mahasiswa Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
