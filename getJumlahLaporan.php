<?php
include "koneksi.php";
require_once "Database.php";

$user_id = $_COOKIE['user_id']; // Ambil user_id dari cookie
$db = new Database($conn);

// Query untuk Total Laporan
$queryLaporan = "SELECT count(*) AS totalLaporan FROM riwayat_pelaporan AS rp
INNER JOIN dosen AS d ON d.dosen_id = rp.dosen_id
INNER JOIN [user] AS u ON u.user_id = d.user_id
WHERE u.user_id = ? AND rp.status NOT IN ('Selesai')";
$params = array($user_id);
$stmt = $db->executeQuery($queryLaporan, $params);
$rowLaporan = $db->fetchAssoc($stmt);
$totalLaporan = $rowLaporan['totalLaporan'];

// Query untuk Total Aju Banding
$queryBanding = "SELECT count(*) AS totalAjuBanding FROM riwayat_pelaporan AS rp
INNER JOIN dosen AS d ON d.dosen_id = rp.dosen_id
INNER JOIN [user] AS u ON u.user_id = d.user_id
INNER JOIN aju_banding AS a ON a.pelaporan_Id = rp.pelaporan_id
WHERE u.user_id = ? AND a.status NOT IN ('Ditolak', 'Diterima')";
$stmt = $db->executeQuery($queryBanding, $params);
$rowBanding = $db->fetchAssoc($stmt);
$totalAjuBanding = $rowBanding['totalAjuBanding'];

// Kembalikan data dalam format JSON
echo json_encode([
    "totalLaporan" => $totalLaporan,
    "totalAjuBanding" => $totalAjuBanding
]);
