<?php
include "koneksi.php";
require_once "Database.php";

$db = new Database($conn);

// Query untuk Total Laporan
$queryLaporan = "SELECT COUNT(*) AS totalLaporan FROM riwayat_pelaporan";
$stmtLaporan = $db->executeQuery($queryLaporan);
$rowLaporan = $db->fetchAssoc($stmtLaporan);
$totalLaporan = $rowLaporan['totalLaporan'] ?? 0;

// Query untuk Total Laporan Selesai
$queryLaporanSelesai = "SELECT COUNT(*) AS totalLaporanSelesai FROM riwayat_pelaporan WHERE status IN ('Selesai')";
$stmtLaporanSelesai = $db->executeQuery($queryLaporanSelesai);
$rowLaporanSelesai = $db->fetchAssoc($stmtLaporanSelesai);
$totalLaporanSelesai = $rowLaporanSelesai['totalLaporanSelesai'] ?? 0;

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode([
    "totalLaporan" => $totalLaporan,
    "totalLaporanSelesai" => $totalLaporanSelesai
]);
