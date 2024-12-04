<?php
include 'koneksi.php'; // File koneksi ke SQL Server

if (isset($_GET['tingkat_id'])) {
    $tingkat_id = $_GET['tingkat_id'];

    // Query untuk mengambil sanksi berdasarkan tingkat_id
    $query = "SELECT sanksi, tingkat FROM tingkat WHERE tingkat_id = ?";
    $params = array($tingkat_id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Ambil data sanksi dari query
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        // Mengembalikan data dalam format JSON
        echo json_encode($row);
    } else {
        echo json_encode(['sanksi' => '']);
    }
}
