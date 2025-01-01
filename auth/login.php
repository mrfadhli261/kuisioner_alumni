<?php
session_start();

// Cek apakah sudah login
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil NIM
    $nim = $_POST['nim'];

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "kuisioner");

    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    // Query untuk mencari NIM di database
    $sql = "SELECT * FROM alumni WHERE nim = '$nim' LIMIT 1";
    $result = $conn->query($sql);

    // Cek apakah NIM ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Simpan data user ke session
        $_SESSION['id'] = $row['id']; // Kolom id
        $_SESSION['nim'] = $row['nim']; // Kolom nim
        header("Location: ../index.php");
    } else {
        $_SESSION['error_message'] = "NIM tidak ditemukan. Silakan coba lagi.";
        header("Location: ../login/login.php");
    }
    $conn->close();
}
