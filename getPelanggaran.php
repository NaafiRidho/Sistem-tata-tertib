<?php
include "koneksi.php";
require_once "Database.php";

$pelanggaran_id = $_GET['pelanggaran_id'];
$db = new Database($conn);
$query = "SELECT p.pelanggaran, t.tingkat_id, t.sanksi FROM pelanggaran AS p
INNER JOIN tingkat AS t ON t.tingkat_id = p.tingkat_id
WHERE p.pelanggaran_id = ?";
$params = array($pelanggaran_id);
$stmt = $db->executeQuery($query, $params);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
} else {
    $data = $db->fetchAssoc($stmt);
    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan."]);
    }
}
?>