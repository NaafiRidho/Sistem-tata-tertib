<?php
include "koneksi.php";
require_once "Database.php";

$pelaporan_id = $_POST['pelaporan_id'];

$uploadDir = 'surat/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$targetFile = null;
if (isset($_FILES['upload-surat']) && $_FILES['upload-surat']['error'] === UPLOAD_ERR_OK) {
    $fileName = basename($_FILES['upload-surat']['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['pdf'];
    if (in_array($fileType, $allowedExtensions)) {
        $targetFile = $uploadDir . $fileName;
        if (!move_uploaded_file($_FILES['upload-surat']['tmp_name'], $targetFile)) {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah file."]);
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Ekstensi file tidak diizinkan."]);
        exit;
    }
}
$db = new Database($conn);
$query = "INSERT INTO document VALUES (?,?,?)";
$params = array($pelaporan_id, $targetFile, "Ditinjau");
$stmt = $db->executeQuery($query, $params);
if ($stmt) {
    echo json_encode(["status" => "success", "message" => "Surat berhasil diupload."]);
} else {
    echo json_encode(["status" => "error", "message" => sqlsrv_errors()]);
}
