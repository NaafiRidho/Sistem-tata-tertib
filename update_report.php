<?php
include "koneksi.php";

$pelaporan_id = $_POST["pelaporan_id"];
$pelanggaran = $_POST["pelanggaran"];
$tingkat = $_POST["tingkat"];

// Query untuk mendapatkan pelanggaran_id
$query = "SELECT pelanggaran_id FROM pelanggaran WHERE pelanggaran = ?";
$stmt = sqlsrv_query($conn, $query, [$pelanggaran]);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$row) {
    echo json_encode(["status" => "error", "message" => "Pelanggaran tidak ditemukan."]);
    exit;
}
$pelanggaran_id = $row['pelanggaran_id'];

// Query untuk mendapatkan tingkat_id
$query = "SELECT tingkat_id FROM tingkat WHERE tingkat = ?";
$stmt = sqlsrv_query($conn, $query, [$tingkat]);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$row) {
    echo json_encode(["status" => "error", "message" => "Tingkat tidak ditemukan."]);
    exit;
}
$tingkat_id = $row['tingkat_id'];

// Query untuk update riwayat_pelaporan
$query = "UPDATE riwayat_pelaporan SET pelanggaran_id = ?, tingkat_id = ? WHERE pelaporan_id = ?";
$stmt = sqlsrv_query($conn, $query, [$pelanggaran_id, $tingkat_id, $pelaporan_id]);

// Mengecek hasil query
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
} else {
    echo json_encode(["status" => "success", "message" => "Data berhasil diupdate"]);
}
