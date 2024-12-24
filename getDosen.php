<?php
include "koneksi.php";
require_once 'Database.php';

$dosen_id = $_GET['dosen_id'];
$db = new Database($conn);
$query  = "SELECT d.nama, d.nidn, u.username, u.password FROM dosen AS d
           INNER JOIN [user] AS u ON u.user_id = d.user_id
           WHERE dosen_id= ?";
$params = array($dosen_id);
$stmt = $db->executeQuery($query, $params);
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
    exit;
} else {
    $data = $db->fetchAssoc($stmt);
    echo json_encode($data);
}
