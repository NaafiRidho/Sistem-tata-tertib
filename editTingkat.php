<?php
include "koneksi.php";
require_once "Database.php";

$tingkat_id = $_POST['tingkat_id'];
$tingkat = $_POST['tingkat'];
$sanksi = $_POST['sanksi'];

$db = new Database($conn);
$query = "UPDATE tingkat set tingkat= ? , sanksi= ? WHERE tingkat_id= ?";
$params = array($tingkat, $sanksi, $tingkat_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Pelanggaran Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
