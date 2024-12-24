<?php
include "koneksi.php";
require_once 'Database.php';

$nama = $_POST['nama'];
$nidn = $_POST['nidn'];
$dosen_id = $_POST['dosen_id'];
$password = $_POST['password'];
$username = $_POST['username'];
$db = new Database($conn);
$query = "UPDATE dosen SET nama= ?,nidn= ? WHERE dosen_id= ? ";
$params = array($nama, $nidn, $dosen_id);
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    require_once "Database.php";
    $db = new Database($conn);
    $query = "SELECT [user].user_id FROM [user]
          INNER JOIN dosen ON dosen.user_id = [user].user_id
          WHERE dosen_id = ?";
    $params = array($dosen_id);
    $stmt = $db->executeQuery($query, $params);
    $user_id_row = $db->fetchAssoc($stmt);

    if (!$user_id_row) {
        echo json_encode(["status" => "error", "message" => "User ID not found for the given dosen_id."]);
        exit;
    }

    $user_id = $user_id_row['user_id'];
    $query = "UPDATE [user] SET username = ?, password = ? WHERE user_id = ?";
    $params = array($username, $password, $user_id);

    $stmtUser = $db->executeQuery($query, $params);
    if ($stmtUser) {
        echo json_encode(["status" => "success", "message" => "Data Dosen Berhasil disimpan."]);
    } else {
        echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
