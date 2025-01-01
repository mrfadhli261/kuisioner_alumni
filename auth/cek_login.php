<?php
include './server/db.php';

//
$isLoggedIn = isset($_SESSION['id']);
$namaPengguna = $isLoggedIn ? $_SESSION['nim'] : ''; // Ambil NIM dari sesi jika login

$userName = ""; // Default nama pengguna kosong

if ($isLoggedIn) {
    // Ambil ID pengguna dari sesi
    $userId = $_SESSION['id'];

    // Query untuk mendapatkan nama pengguna dari tabel alumni
    $sql = "SELECT nama FROM alumni WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userName = $row['nama']; // Simpan nama pengguna
    }

    $stmt->close();
}
