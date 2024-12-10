<?php
include "koneksi.php";
require_once 'Database.php';

if (!isset($_POST['dosen_id'])) {
    echo json_encode(["status" => "error", "message" => "Parameter dosen_id tidak ditemukan."]);
    exit;
}

$dosen_id = $_POST['dosen_id'];
$db = new Database($conn);

// Ambil user_id berdasarkan dosen_id
$query = "SELECT u.user_id FROM [user] AS u
          INNER JOIN dosen AS d ON d.user_id = u.user_id 
          WHERE d.dosen_id = ?";
$params = array($dosen_id);
$stmt = $db->executeQuery($query, $params);

if ($stmt) {
    $data = $db->fetchAssoc($stmt);
    $user_id = $data['user_id'];

    // Hapus data dosen
    $query = "DELETE FROM dosen WHERE dosen_id = ?";
    $stmtDosen = $db->executeQuery($query, array($dosen_id));

    if ($stmtDosen) {
        // Hapus data user
        $query = "DELETE FROM [user] WHERE user_id = ?";
        $stmtUser = $db->executeQuery($query, array($user_id));

        if ($stmtUser) {
            echo json_encode(["status" => "success", "message" => "Data Dosen dan User berhasil dihapus."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Data User gagal dihapus."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal Menghapus data dosen."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Gagal Mendapatkan data user id."]);
}
?>
