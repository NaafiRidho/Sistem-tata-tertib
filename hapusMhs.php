<?php
include "koneksi.php"; // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mahasiswa_id = $_POST['mahasiswa_id'];

    // Query untuk menghapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE mahasiswa_id = ?";
    $params = array($mahasiswa_id);
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(json_encode(["status" => "error", "message" => sqlsrv_errors()]));
    }

    if (sqlsrv_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Data Mahasiswa Berhasil dihapus."]);
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
}
?>