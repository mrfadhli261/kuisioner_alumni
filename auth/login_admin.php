<?php
include '../server/db.php';
// Tangkap input dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Cek username di tabel super_admin
    $querySuperAdmin = "SELECT * FROM super_admin WHERE username = ?";
    $stmtSuperAdmin = $conn->prepare($querySuperAdmin);
    $stmtSuperAdmin->bind_param("s", $inputUsername);
    $stmtSuperAdmin->execute();
    $resultSuperAdmin = $stmtSuperAdmin->get_result();

    if ($resultSuperAdmin->num_rows > 0) {
        // Username ditemukan di tabel super_admin
        $row = $resultSuperAdmin->fetch_assoc();
        if ($inputPassword == $row['password']) {  // Bandingkan password langsung
            // Password cocok
            header("Location: ../admin/index.php");
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        // Jika tidak ditemukan di super_admin, cek di admin_fakultas
        $queryAdminFakultas = "SELECT * FROM admin_fakultas WHERE username = ?";
        $stmtAdminFakultas = $conn->prepare($queryAdminFakultas);
        $stmtAdminFakultas->bind_param("s", $inputUsername);
        $stmtAdminFakultas->execute();
        $resultAdminFakultas = $stmtAdminFakultas->get_result();

        if ($resultAdminFakultas->num_rows > 0) {
            // Username ditemukan di tabel admin_fakultas
            $row = $resultAdminFakultas->fetch_assoc();
            if ($inputPassword == $row['password']) {  // Bandingkan password langsung
                // Password cocok
                header("Location: ../admin_fakultas/index.php");
                exit();
            } else {
                echo "Password salah!";
            }
        } else {
            // Username tidak ditemukan di kedua tabel
            echo "Username tidak ditemukan!";
        }
    }
}
