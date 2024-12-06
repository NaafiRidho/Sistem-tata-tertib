<?php
include "koneksi.php";

if (isset($_GET["pelanggaran_id"])) {
    $pelanggaran_id = $_GET["pelanggaran_id"];

    $query = "SELECT rp.[file] AS bukti, rp.tanggal, m.nama, m.nim, k.prodi, k.nama_kelas, t.tingkat,t.sanksi, p.pelanggaran FROM riwayat_pelaporan AS rp
             INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
             INNER JOIN mahasiswa AS m ON m.mahasiswa_id = rp.mahasiswa_id
             INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
             INNER JOIN tingkat AS t ON t.tingkat_id = rp.tingkat_id
             WHERE rp.pelaporan_id = ?";
    $params = array($pelanggaran_id);
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_execute($stmt);
    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $data['tanggal'] = $data['tanggal']->format('Y-m-d');
    

    echo json_encode($data);
}
