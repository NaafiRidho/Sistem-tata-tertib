<?php
include "koneksi.php";
require_once 'Database.php';

$dosen_id = $_GET['dosen_id'];
$db = new Database($conn);
$query  = "SELECT nama, nidn FROM dosen
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
