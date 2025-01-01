<?php
// mulai sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// masuk ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kuisioner";

//koneksi database
$conn = new mysqli($host, $username, $password, $dbname);

//cek koneksi database
if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}
