<?php
$serverName = "DESKTOP-J2JVCCI"; // Atau IP server SQL Server
$connectionOptions = array(
    "Database" => "sistem-tata-tertib", // Ganti dengan nama database Anda
    "Uid" => "",               // Ganti dengan username SQL Server Anda
    "PWD" => "",      // Ganti dengan password SQL Server Anda
);

// Membuat koneksi
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Cek koneksi
if ($conn === false) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}
?>

