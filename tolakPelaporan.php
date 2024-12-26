<?php
include "koneksi.php";
require_once "Database.php";

$document_id = $_POST['document_id'];
$alasan = $_POST['alasan'];
$db = new Database($conn);

$query = "UPDATE document SET status = ?, alasan= ?  WHERE document_id = ? ";
$params = array("Ditolak", $alasan, $document_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Pelanggaran Ditolak."]);
}
