<?php
include "koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];


$query = "SELECT * FROM dbo.[user] WHERE username = ?";
$params = array($username);


$stmt = sqlsrv_prepare($conn, $query, $params);
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_execute($stmt)) {
    $role = null;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $role = $row["role"];
    }

    if ($role == "Mahasiswa") {
        header("Location: dashboardMhs.php");
        exit();
    }
} else {
    die(print_r(sqlsrv_errors(), true));
}
