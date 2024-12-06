<?php
include "koneksi.php";

$banding_id = $_POST['banding_id'];
$query = "UPDATE aju_banding SET status = 'Ditolak' WHERE banding_id = ?";
$params = array($banding_id);
$stmt = sqlsrv_prepare($conn, $query, $params);

if (sqlsrv_execute($stmt)) {
    // Jika berhasil, kirim respons sukses
    echo json_encode(['message' => 'Aju banding berhasil ditolak.']);
} else {
    // Jika gagal, kirim respons error
    echo json_encode(['message' => 'Gagal menolak aju banding.']);
}
?>