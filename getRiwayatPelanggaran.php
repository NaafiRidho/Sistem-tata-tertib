<?php
include "koneksi.php";

$pelaggaran_id = $_GET['pelanggaran_id'];
$query = "SELECT p.pelanggaran, t.sanksi, t.tingkat, m.nama AS namamhs, m.nim, k.nama_kelas,k.prodi ,rp.tanggal, rp.[file] FROM riwayat_pelaporan AS rp 
INNER JOIN mahasiswa AS m ON rp.mahasiswa_id = m.mahasiswa_id
INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
INNER JOIN pelanggaran AS p ON p.pelanggaran_id = rp.pelanggaran_id
INNER JOIN tingkat AS t ON t.tingkat_id = p.tingkat_id
INNER JOIN [user] AS u ON u.user_id = m.user_id
WHERE rp.pelaporan_id= ? ";

$params = array($pelaggaran_id);
$stmt = sqlsrv_query($conn, $query, $params);
$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$data['tanggal'] = $data['tanggal']->format('Y-m-d');


echo json_encode($data);
