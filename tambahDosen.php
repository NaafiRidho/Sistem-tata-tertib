<?php
include "koneksi.php";
require_once 'Database.php';

$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$nidn = $_POST['nidn'];

$db = new Database($conn);
$query = "INSERT INTO [user] VALUES (?,?,?)";
$params = array($username, $password, "Mahasiswa");
$stmt = $db->executeQuery($query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit; // Pastikan untuk keluar setelah mengirim respons error
}
$row = $db->fetchAssoc($stmt);

$query = "SELECT user_id FROM [user] WHERE username = ?";
$params = array($username);
$stmt = $db->executeQuery($query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit; // Pastikan untuk keluar setelah mengirim respons error
}
$row = $db->fetchAssoc($stmt);
$user_id = $row['user_id'];

$query = "INSERT INTO dosen VALUES (?,?,?)";
$params = array($user_id, $nama, $nidn);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    // Hanya satu respons JSON
    echo json_encode(["status" => "success", "message" => "Data Dosen Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
