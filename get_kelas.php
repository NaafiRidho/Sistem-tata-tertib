<?php
include 'koneksi.php';

if (isset($_GET['prodi'])) {
    $prodi = $_GET['prodi'];

    // Query untuk memuat kelas berdasarkan prodi
    $query = "SELECT DISTINCT nama_kelas FROM kelas WHERE prodi = ?";
    $params = array($prodi);
    $result = sqlsrv_query($conn, $query, $params);

    if ($result === false) {
        http_response_code(500); // Kesalahan server
        die(print_r(sqlsrv_errors(), true));
    }

    // Ambil data dan ubah ke format JSON
    $kelas = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $kelas[] = $row;
    }

    echo json_encode($kelas);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Prodi tidak ditemukan']);
}
?>
