<?php

// Cek apakah sudah login
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

// Periksa apakah ada pesan error
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
    // Hapus pesan error setelah ditampilkan
    unset($_SESSION['error_message']);
}
