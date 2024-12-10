<?php
include "koneksi.php";
require_once 'Database.php';

$nama = $_POST['nama'];
$nidn = $_POST['nidn'];
$dosen_id = $_POST['dosen_id'];
$db = new Database($conn);
$query = "UPDATE dosen SET nama= ?,nidn= ? WHERE dosen_id= ? ";
$params = array($nama, $nidn, $dosen_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Dosen Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
