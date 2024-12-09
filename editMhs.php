<?php
include "koneksi.php";

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$mahasiswa_id = $_POST['mahasiswa_id'];

$query = "SELECT kelas_id FROM kelas WHERE prodi = ? AND nama_kelas= ?";
$params = array($prodi, $kelas);
$stmt = sqlsrv_query($conn, $query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$kelas_id = $row['kelas_id'];

$query = "UPDATE mahasiswa SET kelas_id = ?, nama= ?, nim=? WHERE mahasiswa_id= ? ";
$params = array($kelas_id, $nama, $nim, $mahasiswa_id);
$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Mahasiswa Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
