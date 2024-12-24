<?php
include "koneksi.php";
require_once 'Database.php';

$tingkat = $_POST['tingkat'];
$sanksi = $_POST['sanksi'];

if (!$tingkat || !$sanksi) {
    echo json_encode(["status" => "error", "message" => "Tingkat atau sanksi tidak boleh kosong."]);
    exit;
}

$db = new Database($conn);
$query = "SELECT TOP 1
    tingkat_id 
FROM 
    tingkat
	ORDER BY tingkat_id DESC";
$stmt = $db->executeQuery($query);
$row = $db->fetchAssoc($stmt);
$tingkat_id = $row['tingkat_id'] + 1;

$query = "INSERT INTO tingkat VALUES (?,?, ?)";
$params = array($tingkat_id, $tingkat, $sanksi);
$stmt = $db->executeQuery($query, $params);

if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Data Sanksi Berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
