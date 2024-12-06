<?php
include "koneksi.php";

$pelaporan_id = $_POST['pelaporan_id'];
$query = "UPDATE riwayat_pelaporan SET status = ? WHERE pelaporan_id = ?";
$stmt = sqlsrv_query($conn, $query, ["Dibatalkan",$pelaporan_id]);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
} else {
    echo json_encode(["status" => "success", "message" => "Pelanggaran berhasil Dibatalkan"]);
}
