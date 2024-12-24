<?php
include "koneksi.php";

$mahasiswa_id = $_GET["mahasiswa_id"];
$query = "SELECT m.nama, m.nim, k.nama_kelas, k.prodi, u.username, u.password FROM mahasiswa AS m
INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
INNER JOIN [user] AS u ON u.user_id = m.user_id
WHERE m.mahasiswa_id = ?";
$params = array($mahasiswa_id);
$stmt = sqlsrv_prepare($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
sqlsrv_execute($stmt);
$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo json_encode($data);
