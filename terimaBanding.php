<?php
include "koneksi.php";

$banding_id = $_POST['banding_id'];
$query = "UPDATE aju_banding SET status = 'Diterima' WHERE banding_id = ?";
$params = array($banding_id);
$stmt = sqlsrv_prepare($conn, $query, $params);
$stmt = sqlsrv_execute($stmt);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
} else {
    echo json_encode(["status" => "success", "message" => "Aju Banding Berhasil Diterima"]);
}
