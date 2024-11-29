<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelaporan_id = $_POST['pelaporan_id'];

    $query = "UPDATE dbo.riwayat_pelaporan SET status = 'Diterima' WHERE pelaporan_id = ?";
    $params = array($pelaporan_id);
    $stmt = sqlsrv_prepare($conn, $query, $params);
    if ($stmt == false) {
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Pelanggaran Diterima"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Method tidak valid"]);
}
