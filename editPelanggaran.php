<?php
include "koneksi.php";
require_once "Database.php";

$pelanggaran_id = $_POST['pelanggaran_id'];
$pelanggaran = $_POST['pelanggaran'];
$tingkat_id = $_POST['tingkat_id'];

$db = new Database($conn);
$query = "UPDATE pelanggaran set tingkat_id= ? , pelanggaran= ? WHERE pelanggaran_id= ?";
$params = array($tingkat_id, $pelanggaran, $pelanggaran_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Pelanggaran Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
