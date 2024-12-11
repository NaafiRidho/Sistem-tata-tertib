<?php
include "koneksi.php";
require_once "Database.php";

$pelanggaran_id= $_POST['pelanggaran_id'];
$db = new Database($conn);
$query = "DELETE FROM pelanggaran WHERE pelanggaran_id = ?";
$params = array($pelanggaran_id);
$stmt = $db -> executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Pelanggaran Berhasil dihapus."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
?>