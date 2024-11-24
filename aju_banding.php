<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelaporan_id = $_POST['pelaporan_id'];
    $alasan_banding = $_POST['alasan_banding'];
    $prodi = $_POST['prodi'];
    $query = "";

    if ($prodi == 'SIB') {
        $query = "INSERT INTO dbo.aju_banding VALUES (?,1,?,'Ditinjau',GETDATE())";
    } else if ($prodi == "TI") {
        $query = "INSERT INTO dbo.aju_banding VALUES (?,2,?,'Ditinjau',GETDATE())";
    }
    $params = array($pelaporan_id, $alasan_banding);
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt == false) {
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Banding berhasil diajukan"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Banding gagal"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Method tidak valid"]);
}
