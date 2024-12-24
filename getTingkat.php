<?php
include "koneksi.php";
require_once "Database.php";

$tingkat_id = $_GET["tingkat_id"];
$db = new Database($conn);
$query = "SELECT tingkat ,sanksi FROM tingkat
          WHERE tingkat_id = ?";
$params = array($tingkat_id);
$stmt = $db->executeQuery($query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
} else {
    $data = $db->fetchAssoc($stmt);
    echo json_encode($data);
}
