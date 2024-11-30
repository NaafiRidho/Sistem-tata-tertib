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
        $user_id=$row["user_id"];
    }

    if ($role == "Mahasiswa") {
        setcookie("user_id",$user_id);

        header("Location: dashboardMhs.php");
        exit();
    }
    else if ($role == "Dosen"){
        setcookie("user_id",$user_id);

        header("Location: dashboardDosen.php");
        exit();
    }
} else {
    die(print_r(sqlsrv_errors(), true));
}
