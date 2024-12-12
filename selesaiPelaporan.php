<?php
include "koneksi.php";
require_once "Database.php";

$pelaporan_id = $_POST['pelaporan_id'];
$document_id = $_POST['document_id'];
$db = new Database($conn);

$query = "UPDATE document SET status = ? WHERE document_id = ? ";
$params = array("Selesai" ,$document_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    $query = "UPDATE riwayat_pelaporan SET status = ? WHERE pelaporan_id = ? ";
    $params = array("Selesai" ,$pelaporan_id);
    $stmtPelaporan = $db->executeQuery($query, $params);
    if ($stmtPelaporan) {
        echo json_encode(["status" => "success", "message" => "Pelanggaran Terselesaikan."]);
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
}
