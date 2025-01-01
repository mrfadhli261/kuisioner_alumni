<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Menyertakan CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        body {
            font-family: "Roboto", serif;
        }
    </style>

</head>

<body style="background-color: #ededed;">
    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold"><b>Tracer Study</b></h2>
        <?php
        session_start();
        // Tampilkan pesan sukses jika ada
        if (isset($_SESSION['success_message'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> ' . htmlspecialchars($_SESSION['success_message']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            // Hapus session setelah ditampilkan
            unset($_SESSION['success_message']);
        }
        ?>
        <?php
        include '../server/db.php';

        //ambil data
        $id = $_SESSION['id'];

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        //cek apakah ada pesan
        if (isset($_SESSION['massage'])) {
            echo "<div class='alert alert-info'>" . $_SESSION['massage'] . "</div>";
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
            // Menampilkan data pribadi menggunakan value dalam form
        ?>
            <div class="container mt-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">Data Diri</h4>
                    </div>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="nama" class="form-label mb-0 w-25 mx-3">Nama</label>
                                <input type="text" class="form-control" id="nama" value="<?= htmlspecialchars($row['nama']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="nim" class="form-label mb-0 w-25 mx-3">NIM</label>
                                <input type="text" class="form-control" id="nim" value="<?= htmlspecialchars($row['nim']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="angkatan" class="form-label mb-0 w-25 mx-3">Angkatan</label>
                                <input type="text" class="form-control" id="angkatan" value="<?= htmlspecialchars($row['angkatan']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="prodi" class="form-label mb-0 w-25 mx-3">Nama Prodi</label>
                                <input type="text" class="form-control" id="prodi" value="<?= htmlspecialchars($row['nama_prodi']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="fakultas" class="form-label mb-0 w-25 mx-3">Nama Fakultas</label>
                                <input type="text" class="form-control" id="fakultas" value="<?= htmlspecialchars($row['nama_fakultas']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="ipk" class="form-label mb-0 w-25 mx-3">IPK</label>
                                <input type="text" class="form-control" id="ipk" value="<?= htmlspecialchars($row['ipk']) ?>" readonly>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <label for="lulus" class="form-label mb-0 w-25 mx-3">Lulus</label>
                                <input type="text" class="form-control" id="lulus" value="<?= htmlspecialchars($row['lulus']) ?>" readonly>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="status" class="form-label mb-0 w-25 mx-3">Status Kuisioner</label>
                                <input type="text" class="form-control" id="status" value="<?= $row['alumni_id'] !== null ? 'Sudah Mengisi Kuisioner' : 'Belum Mengisi Kuisioner' ?>" readonly>
                            </div>
                            <?php if ($row['alumni_id'] !== null): ?>
                                <!-- Bagian ini hanya akan tampil jika alumni_id tidak null -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="alamat" class="form-label mb-0 w-25 mx-3">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" value="<?= htmlspecialchars($row['alamat']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="provinsi" class="form-label mb-0 w-25 mx-3">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" value="<?= htmlspecialchars($row['nama_provinsi']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="kabupaten" class="form-label mb-0 w-25 mx-3">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" value="<?= htmlspecialchars($row['nama_kabupaten']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="kode_pos" class="form-label mb-0 w-25 mx-3">Kode Pos</label>
                                    <input type="text" class="form-control" id="kode_pos" value="<?= htmlspecialchars($row['kode_pos']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="nomor_hp" class="form-label mb-0 w-25 mx-3">Nomor HP</label>
                                    <input type="text" class="form-control" id="nomor_hp" value="<?= htmlspecialchars($row['nomor_hp']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="email" class="form-label mb-0 w-25 mx-3">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($row['email']) ?>" readonly>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <label for="jenis_kelamin" class="form-label mb-0 w-25 mx-3">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" value="<?= htmlspecialchars($row['jenis_kelamin']) ?>" readonly>
                                </div>
                            <?php endif; ?>
                            <hr class="my-4">

                            <?php if ($row['alumni_id'] !== null): ?>
                                <a href='../index.php' class='btn btn-success'>Kembali ke Homepage</a>
                            <?php else: ?>
                                <a href='../kuisioner/kuisioner.php' class='btn btn-primary'>Isi Kuisioner</a>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>
            </div>

        <?php
        } else {
            echo "<div class='alert alert-warning mt-4'>Data tidak ditemukan.</div>";
        }

        $conn->close();
        ?>
    </div>


    <!-- Menyertakan JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>