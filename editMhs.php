<?php
include "koneksi.php";

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$mahasiswa_id = $_POST['mahasiswa_id'];
$username = $_POST['username'];
$password = $_POST['password'];

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
    require_once "Database.php";
    $db = new Database($conn);
    $query = "SELECT [user].user_id FROM [user]
          INNER JOIN mahasiswa ON mahasiswa.user_id = [user].user_id
          WHERE mahasiswa_id = ?";
    $params = array($mahasiswa_id);
    $stmt = $db->executeQuery($query, $params);
    $user_id_row = $db->fetchAssoc($stmt);

    if (!$user_id_row) {
        echo json_encode(["status" => "error", "message" => "User ID not found for the given mahasiswa_id."]);
        exit;
    }

    $user_id = $user_id_row['user_id'];
    $query = "UPDATE [user] SET username = ?, password = ? WHERE user_id = ?";
    $params = array($username, $password, $user_id);

    $stmtUser = $db->executeQuery($query, $params);
    if ($stmtUser) {
        echo json_encode(["status" => "success", "message" => "Data Mahasiswa Berhasil disimpan."]);
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
