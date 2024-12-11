<?php
include "koneksi.php";
require_once 'Database.php';

$tingkat_id = $_POST['tingkat_id'];
$pelanggaran = $_POST['pelanggaran'];
$db = new Database($conn);
$query = "INSERT INTO pelanggaran VALUES (?,?)";
$params = array($tingkat_id, $pelanggaran);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Pelanggaran Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
