<?php
include "koneksi.php"; // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mahasiswa_id = $_POST['mahasiswa_id'];

    // Query untuk mengambil username
    $query = "SELECT u.username FROM [user] AS u
              INNER JOIN mahasiswa AS m ON m.user_id = u.user_id
              WHERE m.mahasiswa_id = ?";
    $params = array($mahasiswa_id);
    $stmt = sqlsrv_prepare($conn, $query, $params);
    if ($stmt === false) {
        die(json_encode(["status" => "error", "message" => sqlsrv_errors()]));
    }
    sqlsrv_execute($stmt);
    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!$data) {
        echo json_encode(["status" => "error", "message" => "User tidak ditemukan."]);
        exit;
    }
    $username = $data['username'];

    // Query untuk menghapus data user
    $query = "DELETE FROM [user] WHERE username = ?";
    $params = array($username);
    $stmtDeleteUser = sqlsrv_prepare($conn, $query, $params);
    if ($stmtDeleteUser === false) {
        die(json_encode(["status" => "error", "message" => sqlsrv_errors()]));
    }

    // Jika constraint menghalangi, hapus data mahasiswa terlebih dahulu
    $query = "DELETE FROM mahasiswa WHERE user_id = (SELECT user_id FROM [user] WHERE username = ?)";
    $params = array($username);
    $stmtDeleteMahasiswa = sqlsrv_prepare($conn, $query, $params);

    if ($stmtDeleteMahasiswa === false) {
        die(json_encode(["status" => "error", "message" => sqlsrv_errors()]));
    }

    if (sqlsrv_execute($stmtDeleteMahasiswa)) {
        // Kemudian, hapus data user
        if (sqlsrv_execute($stmtDeleteUser)) {
            echo json_encode(["status" => "success", "message" => "Data Mahasiswa dan User berhasil dihapus."]);
        } else {
            echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
}
