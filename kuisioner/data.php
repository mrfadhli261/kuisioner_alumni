<?php
include '../server/db.php';

//ambil data
$id = $_SESSION['id'];

if ($conn->connect_error) {
    die("koneksi gagal" . $conn->connect_error);
}

//cek apakah ada pesan
if (isset($_SESSION['massage'])) {
    echo "<p>" . $_SESSION['massage'] . "</p>";
    unset($_SESSION['massage']); // Ini penting untuk menghindari pengulangan pesan
}

$sql = "SELECT a.nama,a.nim, a.angkatan, p.nama_prodi, f.nama_fakultas, a.ipk, a.lulus, k.*, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten
FROM alumni a
LEFT JOIN prodi p ON a.prodi_id = p.id
LEFT JOIN fakultas f ON p.fakultas_id = f.id
LEFT JOIN kuisioner k ON a.id = k.alumni_id 
LEFT JOIN provinsi prov ON k.provinsi_id = prov.id
LEFT JOIN kabupaten kab ON k.kabupaten_id = kab.id
WHERE a.id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //data pribadi
    echo "<h3>Data Pribadi Anda</h3>";
    echo "<p>Nama: " . $row["nama"] . "</p>";
    echo "<p>NIM : " . $row["nim"] . "</p>";
    echo "<p>Jenis Kelamin : " . $row["jenis_kelamin"] . "</p>";
    echo "<p>Angkatan: " . $row["angkatan"] . "</p>";
    echo "<p>Nama Prodi: " . $row["nama_prodi"] . "</p>";
    echo "<p>Nama Fakultas: " . $row["nama_fakultas"] . "</p>";
    echo "<p>IPK: " . $row["ipk"] . "</p>";
    echo "<p>Lulus: " . $row["lulus"] . "</p>";
    if ($row['alumni_id'] !== NULL) {
        echo "<p>Alamat: " . $row["alamat"] . "</p>";
        echo "<p>Provinsi: " . $row["nama_provinsi"] . "</p>";
        echo "<p>Kabupaten: " . $row["nama_kabupaten"] . "</p>";
        echo "<p>Kode Pos: " . $row["kode_pos"] . "</p>";
        echo "<p>Nomor Hp: " . $row["nomor_hp"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>Jenis Kelamin : " . $row["jenis_kelamin"] . "</p>";
    } else {
    }
    //data kuisioner
    if ($row['alumni_id'] !== null) {
        echo "<p>Status Kuisioner: <strong>Sudah Mengisi Kuisioner</strong></p>";
        echo "<a href='../index.php'>Homepage</a>";
    } else {
        echo "<p>Status Kuisioner: <strong>Belum Mengisi Kuisioner</strong></p>";
        echo "<a href='../kuisioner/kuisioner.php'><button type='button'>Isi Kuisioner</button></a>";
    }
} else {
    echo "<p>Data tidak ditemukan.</p>";
}

$conn->close();
