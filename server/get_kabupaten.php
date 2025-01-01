<?php
include 'db.php'; // Sambungkan ke database

if (isset($_GET['provinsi_id'])) {
    $provinsi_id = intval($_GET['provinsi_id']);
    $stmt = $conn->prepare("SELECT id, nama_kabupaten FROM kabupaten WHERE provinsi_id = ?");
    $stmt->bind_param("i", $provinsi_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $kabupaten = [];
    while ($row = $result->fetch_assoc()) {
        $kabupaten[] = $row;
    }

    echo json_encode($kabupaten);
}
