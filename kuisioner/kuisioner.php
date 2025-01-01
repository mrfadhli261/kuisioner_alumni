<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner</title>
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

<body style="background-color: #c8c8c8;">
    <div>
        <header>
            <div>
            </div>
        </header>
    </div>
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="container mt-5">
            <?php
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

            <section class="content">
                <div class="card" style="background-color: #ededed;">
                    <div class="content-header">
                        <div class="flex-col">
                            <div class="d-md-flex align-items-center justify-content-center text-center">
                                <h4 class="text-center mb-5 mt-5 fw-bold" style="color: black;"><b>FORM Kuesioner Alumni UIN SUSKA RIAU</b></h4>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="container">
                            <form action="process.php" method="POST">
                                <div class="container">
                                    <div class="container mb-1">
                                        <h5>Pertanyaan dengan tanda (<span class="text-danger">*</span>) wajib diisi</h5>
                                    </div>
                                    <!-- Data Diri -->
                                    <div id="data_diri" class="card shadow-sm">
                                        <?php
                                        include "../server/db.php";
                                        //ambil data dari database
                                        $id = $_SESSION['id'];

                                        //query untuk ambil data dari database alumni
                                        $sql = "SELECT a.*, p.nama_prodi
                                            FROM alumni a
                                            LEFT JOIN prodi p ON a.prodi_id = p.id 
                                            WHERE a.id = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        //cek data ketemu atau tidak
                                        if ($result->num_rows === 1) {
                                            $alumni = $result->fetch_assoc();
                                        } else {
                                            echo "Data tidak ditemukan";
                                            exit();
                                        }

                                        $stmt->close();
                                        $conn->close();
                                        ?>
                                        <div class="card-header with-border">
                                            <h4 class="mb-0">A. Data Pribadi</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6 form-group">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="nama">1. Nama (<span class="text-danger">*</span>)</h6>
                                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= htmlspecialchars($alumni['nama']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="nim">2. Nim (<span class="text-danger">*</span>)</h6>
                                                    <input type="text" class="form-control" name="nim" id="nim" value="<?= htmlspecialchars($alumni['nim']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="angkatan">3. Angkatan (<span class="text-danger">*</span>)</h6>
                                                    <input type="text" class="form-control" name="angkatan" id="angkatan" value="<?= htmlspecialchars($alumni['angkatan']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="prodi_id">4. Program Studi (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="prodi_id" id="prodi_id" value="<?= htmlspecialchars($alumni['nama_prodi']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="ipk">5. IPK (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="ipk" id="ipk" value="<?= htmlspecialchars($alumni['ipk']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="lulus">6. Lulus (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="lulus" id="lulus" value="<?= htmlspecialchars($alumni['lulus']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="alamat">7. Alamat (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="alamat" id="alamat" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="provinsi">8. Provinsi (<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="provinsi" id="provinsi" required onchange="loadKabupaten()">
                                                        <option value="">Pilih...</option>
                                                        <?php
                                                        // Ambil data provinsi dari database
                                                        include '../server/db.php'; // Sambungkan ke database
                                                        $result = $conn->query("SELECT id, nama_provinsi FROM provinsi");
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['nama_provinsi'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="kabupaten">9. Kota/Kabupaten(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="kabupaten" id="kabupaten" required>
                                                        <option value="">Pilih...</option> <!-- Tambahkan opsi default -->
                                                        <script>
                                                            function loadKabupaten() {
                                                                const provinsiId = document.getElementById('provinsi').value;
                                                                const kabupatenSelect = document.getElementById('kabupaten');
                                                                kabupatenSelect.innerHTML = '<option value="">Pilih...</option>'; // Reset dropdown kabupaten

                                                                if (provinsiId) {
                                                                    fetch(`../server/get_kabupaten.php?provinsi_id=${provinsiId}`)
                                                                        .then(response => response.json())
                                                                        .then(data => {
                                                                            data.forEach(kabupaten => {
                                                                                const option = document.createElement('option');
                                                                                option.value = kabupaten.id;
                                                                                option.textContent = kabupaten.nama_kabupaten;
                                                                                kabupatenSelect.appendChild(option);
                                                                            });
                                                                        })
                                                                        .catch(error => console.error('Error fetching kabupaten:', error));
                                                                }
                                                            }
                                                        </script>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="kode_pos">10. Kode Pos (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="kode_pos" id="kode_pos" required oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="nomor_hp">11. Telepon (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="nomor_hp" id="nomor_hp" required oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka, spasi, atau tanda + (8-20 karakter).</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="email">12. Email (<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="email" name="email" id="email" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="jenis_kelamin">13. Jenis Kelamin (<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="">Pilih...</option>
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <!-- status pekerjaan -->
                                    <div id="status_kerja" class="card mt-3 shadow-sm">
                                        <div class="card-body">
                                            <div class="row g-3 ">
                                                <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q13a">Apakah Anda sudah bekerja?*(<span class="text-danger">*</span>)</h6>
                                                <select class="form-select" name="q13a" id="q13a" required onchange="toggleadd13a(this.value)">
                                                    <option value="">Pilih...</option>
                                                    <option value="1">Sudah</option>
                                                    <option value="2">Belum</option>
                                                    <option value="3">Melanjutkan Kuliah</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <!-- Pekerjaan saat ini -->
                                    <div id="pekerjaan_section" class="shadow-sm hidden card mt-3">
                                        <div class="card-header">
                                            <h4 class="mb-0">B. Pekerjaan Saat Ini</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q14">14. Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q14" id="q14" onchange="toggleadd14(this.value)">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Instansi pemerintah</option>
                                                        <option value="2">BUMN multinasional (ex :pertamina, telkom, dll)</option>
                                                        <option value="3">BUMN nasional (ex : PT> Hutama KArya, PT. Berdikari, dll)</option>
                                                        <option value="4">Organisai non-profit/Lembaga Swadaya Masyarakat</option>
                                                        <option value="5">Perusahaan Swasta Multinasional (ex: Microsoft, Danone, dll)</option>
                                                        <option value="6">Perusahaan Swasta Nasional (ex: PT. Sampoerna, Unilever, dll)</option>
                                                        <option value="7">Pengusaha/ Wirausaha</option>
                                                        <option value="8">lainnya...</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 hidden" id="kerja_lainnya">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for=" q14a">14a. Jenis pekerjaan lainnya(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q14a" id="q14a" type="text">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q15a">15a. Nama Kantor(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q15a" id="q15a" type="text">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q15b">15b. Nama Pimpinan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q15b" id="q15b" type="text">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q15c">15c. Email Pimpinan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q15c" id="q15c" type="email">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q16">16. Pekerjaan saat ini bergerak di bidang?(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q16" id="q16" type="text">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q17">17. Tahun mulai kerja(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q17" id="q17" type="text" oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q18">18. No. Telepon/HP Pimpinan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q18" id="q18" type="text" oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka, spasi, atau tanda + (8-20 karakter).</small>
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q19">19. Website Kantor(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q19" id="q19" type="url">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q20">20. Alamat Kantor Perusahaan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" name="q20" id="q20" type="text">
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q21">21. Penghasilan Per bulan saat ini(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q21" id="q21">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah Rp. 1.000.000,-</option>
                                                        <option value="2">Antara Rp. 1.000.000,--Rp. 1.500.000,-</option>
                                                        <option value="3">Antara Rp. 3.000.000,--Rp. 5.000.000,-</option>
                                                        <option value="4">Diatas Rp. 5.000.000,-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q22">22. Status Pekerjaan(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q22" id="q22">
                                                        <option value="">pilih...</option>
                                                        <option value="1">PNS</option>
                                                        <option value="2">Pegawai Bank </option>
                                                        <option value="3">Honorer</option>
                                                        <option value="4">Direktur</option>
                                                        <option value="5">Manajer</option>
                                                        <option value="6">Staff</option>
                                                        <option value="7">Magang</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q23">23. Menurut anda apakah pekerjaan anda saat ini berhubungan dengan program studi anda?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q23" id="q23">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Rendah</option>
                                                        <option value="2">Sedang</option>
                                                        <option value="3">Tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q24">24. Kapan anda mendapatkan perkerjaan saat ini?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q24" id="q24">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah tiga bulan setelah lulus kuliah</option>
                                                        <option value="2">3-6 bulan setelah lulus kuliah</option>
                                                        <option value="3">6-18 bulan setelah lulus kuliah</option>
                                                        <option value="4">diatas 18 bulan setelah lulus kuliah</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q25">25. Tingkat pendidikan apa yang paling tepat/sesuai dengan pekerjaan anda saat ini(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q25" id="q25">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Setingkat lebih Tinggi</option>
                                                        <option value="2">Tingkat yang sama</option>
                                                        <option value="3">Setingkat lebih rendah</option>
                                                        <option value="4">Tidak perlu pendidikan tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q25a">Apakah ini perkerjaan pertama setelah lulus(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q25a" id="q25a" onchange="toggleadd25(this.value)">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Ya</option>
                                                        <option value="2">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <!-- pekerjaan pertama -->
                                    <div id="pekerjaan_pertama" class="shadow-sm hidden card mt-3">
                                        <div class="card-header">
                                            <h4 class="mb-0">Pekerjaan Pertama</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q26">26. Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q26" id="q26">
                                                        <option value="">pilih...</option>
                                                        <option value=" 1">Instansi pemerintah</option>
                                                        <option value="2">BUMN multinasional (ex :pertamina, telkom, dll)</option>
                                                        <option value="3">BUMN nasional (ex : PT> Hutama KArya, PT. Berdikari, dll)</option>
                                                        <option value="4">Organisai non-profit/Lembaga Swadaya Masyarakat</option>
                                                        <option value="5">Perusahaan Swasta Multinasional (ex: Microsoft, Danone, dll)</option>
                                                        <option value="6">Perusahaan Swasta Nasional (ex: PT. Sampoerna, Unilever, dll)</option>
                                                        <option value="7">Pengusaha/ Wirausaha</option>
                                                        <option value="8">lainnya...</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q27">27. Nama kantor/perusahaan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q27" id="q27">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q28">28. Alasan anda pindah atau berhenti dari pekerjaan sebelumnya(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q28" id="q28">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q29">29. Alamat kantor(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q29" id="q29">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q30">30. Gaji pertama(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q30" id="q30">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah Rp. 1.000.000,-</option>
                                                        <option value="2">Antara Rp. 1.000.000,--Rp. 1.500.000,-</option>
                                                        <option value="3">Antara Rp. 3.000.000,--Rp. 5.000.000,-</option>
                                                        <option value="4">Diatas Rp. 5.000.000,-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q31">31. Lama Bekerja (dalam bulan)(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="number" name="q31" id="q31">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q32">32. Menurut anda apakah pekerjaan anda berhubungan dengan program studi anda(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q32" id="q32">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Rendah</option>
                                                        <option value="2">Sedang</option>
                                                        <option value="3">Tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q33">33. Kapan anda mendapatkan perkerjaan saat ini?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q33" id="q33">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah tiga bulan setelah lulus kuliah</option>
                                                        <option value="2">3-6 bulan setelah lulus kuliah</option>
                                                        <option value="3">6-18 bulan setelah lulus kuliah</option>
                                                        <option value="4">diatas 18 bulan setelah lulus kuliah</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q34">34. Status Pekerjaan(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q34" id="q34">
                                                        <option value="">pilih...</option>
                                                        <option value="1">PNS</option>
                                                        <option value="2">Pegawai Bank </option>
                                                        <option value="3">Honorer</option>
                                                        <option value="4">Direktur</option>
                                                        <option value="5">Manajer</option>
                                                        <option value="6">Staff</option>
                                                        <option value="7">Magang</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kegiatan Pendidikan dan Pengalaman Pembelajaran -->
                                <div class="container">
                                    <div id="pengalaman_section" class="shadow-sm card mt-3">
                                        <div class="card-header">
                                            <h4 class="mb-0">C. Kegiatan Pendidikan dan Pengalaman Pembelajaran</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q35">35. Selama kuliah, kebanyakan anda tinggal di?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q35" id="q35" required>
                                                        <option value="">pilih...</option>
                                                        <option value="1">Sendiri di tempat kos</option>
                                                        <option value="2">Bersama orang tua</option>
                                                        <option value="3">Bersama saudara</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q36">36. Siapa yang terutama membayara kuliah andaa(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q36" id="q36" required>
                                                        <option value="">pilih...</option>
                                                        <option value="1">Beasiswa(dari pemerintah/sekolah/yayasan)</option>
                                                        <option value="2">sebagian beasiswa</option>
                                                        <option value="3">orangtua/saudara</option>
                                                        <option value="4">biaya sendiri</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q37">37. Selama kuliah apakah anda menjadi anggota dari suatu organisasi baik di dalam atau di luar kampus(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q37" id="q37" required onchange="toggleadd37(this.value)">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Ya</option>
                                                        <option value="2">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 hidden" id="aktif_org">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q38">38. Seberapa aktif anda di organisasi tersebut(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q38" id="q38">
                                                        <option value="">pilih...</option>
                                                        <option value="1">pasif</option>
                                                        <option value="2">cukup aktif</option>
                                                        <option value="3">sedang aktig</option>
                                                        <option value="4">sangat aktig</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q39">39. Pada saat anda kuliah di perguruan tinggi, apakah anda mengambil kursus atau perndidikan tambahan(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q39" id="q39" required onchange="toggleadd39(this.value)">
                                                        <option value="">pilih...</option>
                                                        <option value="1">ya</option>
                                                        <option value="2">tidak</option>
                                                    </select>
                                                </div>
                                                <div id="kursus_apa" class="hidden col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q39a">39a. Kursus apa yang anda ambil untuk pendidikan tambahan(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q39a" id="q39a">
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover mt-3">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">40. Menurut anda, seberapa besar penekanan pada aspek-aspek pembelejaran di bawah ini dilaksanakan di program studi anda</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Baik</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Baik</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>40a. Perkuliahan</td>
                                                                <td class="text-center"><input type="radio" name="q40a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>40b. Demonstrasi (Praktek)</td>
                                                                <td class="text-center"><input type="radio" name="q40b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>40c. Partisipasi dalam riset</td>
                                                                <td class="text-center"><input type="radio" name="q40c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>40d. Diskusi</td>
                                                                <td class="text-center"><input type="radio" name="q40d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>40e. Praktek Kerja Lapangan</td>
                                                                <td class="text-center"><input type="radio" name="q40e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>40f. Seminar / Workshop</td>
                                                                <td class="text-center"><input type="radio" name="q40f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q40f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q40f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q40f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q40f" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">41. Bagaimana penilaian anda terhadap aspek belajar mengajar di bawah ini </th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Baik</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Baik</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>41a. Kesempatan untuk berinteraksi dengan dosen-dosen di luar jadwal kuliah</td>
                                                                <td class="text-center"><input type="radio" name="q41a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q41a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q41a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q41a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q41a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>41b. pembimbingan akademik</td>
                                                                <td class="text-center"><input type="radio" name="q41b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q41b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q41b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q41b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q41b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>41c. kesempatan berpartisipasi dalam proyek riset</td>
                                                                <td class="text-center"><input type="radio" name="q41c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q41c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q41c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q41c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q41c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>41d. kondisi umum belajar mengajar</td>
                                                                <td class="text-center"><input type="radio" name="q41d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q41d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q41d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q41d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q41d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>41e. kesempatan untuk memasuki dan menjadi bagian dari jejaring ilmiah professional</td>
                                                                <td class="text-center"><input type="radio" name="q41e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q41e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q41e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q41e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q41e" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">42. Bagaimana penilaian anda terhadap kondisi fasilitas belajar dibawah ini</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Baik</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Baik</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>42a. Perpustakaan</td>
                                                                <td class="text-center"><input type="radio" name="q42a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42b. Teknologi informasi dan komunikasi</td>
                                                                <td class="text-center"><input type="radio" name="q42b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42c. Modul belajar</td>
                                                                <td class="text-center"><input type="radio" name="q42c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42d. Ruang belajar</td>
                                                                <td class="text-center"><input type="radio" name="q42d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42e. Laboratorium</td>
                                                                <td class="text-center"><input type="radio" name="q42e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42f. Variasi mata kuliah yang ditawarkan</td>
                                                                <td class="text-center"><input type="radio" name="q42f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42f" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42g. Kantin</td>
                                                                <td class="text-center"><input type="radio" name="q42g" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42g" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42g" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42g" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42g" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42h. Unit kegiatan mahasiswa dan fasilitasnya</td>
                                                                <td class="text-center"><input type="radio" name="q42h" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42h" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42h" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42h" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42h" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42i. Fasilitas layanan kesehatan</td>
                                                                <td class="text-center"><input type="radio" name="q42i" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42i" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42i" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42i" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42i" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42j. Toilet</td>
                                                                <td class="text-center"><input type="radio" name="q42j" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42j" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42j" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42j" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42j" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42k. Masjid</td>
                                                                <td class="text-center"><input type="radio" name="q42k" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q42k" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q42k" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q42k" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q42k" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">43. Bagaimana penilaian anda terhadap pengalaman belajar dibawah ini</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Buruk</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Baik</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Baik</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>43a. Pembelajaran di kelas</td>
                                                                <td class="text-center"><input type="radio" name="q43a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43b. Praktikum / Praktek kerja lapangan</td>
                                                                <td class="text-center"><input type="radio" name="q43b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43c. Pengabdian pada masyarakat</td>
                                                                <td class="text-center"><input type="radio" name="q43c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43d. Penulisan tugas akhir/Proyek akhir</td>
                                                                <td class="text-center"><input type="radio" name="q43d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43e. Organisasi kemahasiswaan</td>
                                                                <td class="text-center"><input type="radio" name="q43e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43f. Kegiatan kemahasiswaan</td>
                                                                <td class="text-center"><input type="radio" name="q43f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43f" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>43g. Olahraga</td>
                                                                <td class="text-center"><input type="radio" name="q43g" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q43g" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q43g" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q43g" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q43g" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="container">
                                    <!-- tingkat kompetensi -->
                                    <div id="tingkat_kompetensi" class="shadow-sm card mt-3">
                                        <div class="card-header">
                                            <h4>C. Tingkat Kompetensi alumni</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">44. Pada saat lulus, pada tingkat mana kompetensi dibawah ini yang anda kuasai</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Rendah</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Rendah</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Tinggi</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Tinggi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>44a. Pengetahuan di bidang atau disiplin ilmu anda</td>
                                                                <td class="text-center"><input type="radio" name="q44a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44b. Pengetahuan di luar bidang atau disiplin ilmu anda</td>
                                                                <td class="text-center"><input type="radio" name="q44b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44c. Pengetahuan alam</td>
                                                                <td class="text-center"><input type="radio" name="q44c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44d. Keterampilan internet</td>
                                                                <td class="text-center"><input type="radio" name="q44d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44e. Keterampilan komputer</td>
                                                                <td class="text-center"><input type="radio" name="q44e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44f. Berpikir kritis</td>
                                                                <td class="text-center"><input type="radio" name="q44f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44f" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44g. Keterampilan riset</td>
                                                                <td class="text-center"><input type="radio" name="q44g" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44g" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44g" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44g" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44g" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44h. Kemampuan belajar</td>
                                                                <td class="text-center"><input type="radio" name="q44h" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44h" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44h" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44h" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44h" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44i. Kemampuan berkomunikasi</td>
                                                                <td class="text-center"><input type="radio" name="q44i" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44i" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44i" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44i" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44i" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44j. Manajemen waktu</td>
                                                                <td class="text-center"><input type="radio" name="q44j" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44j" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44j" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44j" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44j" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44k. Bekerja secara mandiri</td>
                                                                <td class="text-center"><input type="radio" name="q44k" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44k" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44k" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44k" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44k" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44l. Bekerja dalam tim/bekerja sama dengan orng lain</td>
                                                                <td class="text-center"><input type="radio" name="q44l" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44l" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44l" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44l" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44l" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44m. Kemampuan dalam memecahkan masalah</td>
                                                                <td class="text-center"><input type="radio" name="q44m" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44m" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44m" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44m" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44m" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44n. Kemampuan analisis</td>
                                                                <td class="text-center"><input type="radio" name="q44n" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44n" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44n" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44n" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44n" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44o. Kemampuan dalam memegang tanggung jawab</td>
                                                                <td class="text-center"><input type="radio" name="q44o" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44o" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44o" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44o" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44o" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44p. Manajemen proyek/program</td>
                                                                <td class="text-center"><input type="radio" name="q44p" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44p" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44p" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44p" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44p" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44q. Kemampuan untuk mempresentasikan ide/produk/laporan</td>
                                                                <td class="text-center"><input type="radio" name="q44q" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44q" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44q" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44q" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44q" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>44r. Kemampuan dalam menuliskan laporan, memo, dokumen</td>
                                                                <td class="text-center"><input type="radio" name="q44r" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q44r" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q44r" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q44r" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q44r" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">45. Sejauh mana program studi anda bermanfaat untuk hal-hal dibawah ini?</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Tidak Sama Sekali</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Kecil</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Besar</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Besar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>45a. Memulai pekerjaan</td>
                                                                <td class="text-center"><input type="radio" name="q45a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>45b. Pembelajaran lanjut dalam pekerjaan</td>
                                                                <td class="text-center"><input type="radio" name="q45b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>45c. Kinerja dalam menjalankan tugas</td>
                                                                <td class="text-center"><input type="radio" name="q45c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>45d. Karir di masa depan</td>
                                                                <td class="text-center"><input type="radio" name="q45d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>45e. Pengembangan diri</td>
                                                                <td class="text-center"><input type="radio" name="q45e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>45f. Meningkatkan keterampilan kewirausahaan</td>
                                                                <td class="text-center"><input type="radio" name="q45f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q45f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q45f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q45f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q45f" value="5" required></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70%;">46. Seberapa besar peran kompetensi yang diperoleh di perguruan tinggi berikut ini dalam melaksanakaan pekerjaan anda</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Tidak Sama Sekali</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Kecil</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sedang</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Besar</th>
                                                                <th class="text-center align-middle" style="width: 6%;">Sangat Besar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>46a. Pengetahuan di bidang atau disiplin ilmu anda</td>
                                                                <td class="text-center"><input type="radio" name="q46a" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46a" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46a" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46a" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46a" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46b. Pengetahuan di luar bidang atau disiplin ilmu anda</td>
                                                                <td class="text-center"><input type="radio" name="q46b" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46b" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46b" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46b" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46b" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46c. Pengetahuan alam</td>
                                                                <td class="text-center"><input type="radio" name="q46c" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46c" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46c" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46c" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46c" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46d. Keterampilan internet</td>
                                                                <td class="text-center"><input type="radio" name="q46d" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46d" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46d" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46d" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46d" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46e. Keterampilan komputer</td>
                                                                <td class="text-center"><input type="radio" name="q46e" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46e" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46e" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46e" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46e" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46f. Berpikir kritis</td>
                                                                <td class="text-center"><input type="radio" name="q46f" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46f" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46f" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46f" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46f" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46g. Keterampilan riset</td>
                                                                <td class="text-center"><input type="radio" name="q46g" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46g" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46g" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46g" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46g" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46h. Kemampuan belajar</td>
                                                                <td class="text-center"><input type="radio" name="q46h" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46h" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46h" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46h" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46h" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46i. Kemampuan berkomunikasi</td>
                                                                <td class="text-center"><input type="radio" name="q46i" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46i" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46i" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46i" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46i" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46j. Manajemen waktu</td>
                                                                <td class="text-center"><input type="radio" name="q46j" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46j" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46j" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46j" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46j" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46k. Bekerja secara mandiri</td>
                                                                <td class="text-center"><input type="radio" name="q46k" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46k" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46k" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46k" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46k" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>42l. Bekerja dalam tim/bekerja sama dengan orng lain</td>
                                                                <td class="text-center"><input type="radio" name="q46l" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46l" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46l" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46l" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46l" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46m. Kemampuan dalam memecahkan masalah</td>
                                                                <td class="text-center"><input type="radio" name="q46m" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46m" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46m" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46m" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46m" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46n. Kemampuan analisis</td>
                                                                <td class="text-center"><input type="radio" name="q46n" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46n" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46n" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46n" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46n" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46o. Kemampuan dalam memegang tanggung jawab</td>
                                                                <td class="text-center"><input type="radio" name="q46o" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46o" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46o" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46o" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46o" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46p. Manajemen proyek/program</td>
                                                                <td class="text-center"><input type="radio" name="q46p" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46p" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46p" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46p" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46p" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46q. Kemampuan untuk mempresentasikan ide/produk/laporan</td>
                                                                <td class="text-center"><input type="radio" name="q46q" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46q" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46q" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46q" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46q" value="5" required></td>
                                                            </tr>
                                                            <tr>
                                                                <td>46r. Kemampuan dalam menuliskan laporan, memo, dokumen</td>
                                                                <td class="text-center"><input type="radio" name="q46r" value="1" required></td>
                                                                <td class="text-center"><input type="radio" name="q46r" value="2" required></td>
                                                                <td class="text-center"><input type="radio" name="q46r" value="3" required></td>
                                                                <td class="text-center"><input type="radio" name="q46r" value="4" required></td>
                                                                <td class="text-center"><input type="radio" name="q46r" value="5" required></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q47">47. Pada saat anda lulus dari perguruan tinggi, bagaimana tingkat kemampuan bahasa asing anda?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q47" id="q47" required>
                                                        <option value="">Pilih...</option>
                                                        <option value="1">Sangat rendah</option>
                                                        <option value="2">Rendah</option>
                                                        <option value="3">Sedang</option>
                                                        <option value="4">Tinggi</option>
                                                        <option value="5">Sangat Tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q48">48. Seberapa besar kontribusi perguruan tinggi dalam penguasaan bahasa asing(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q48" id="q48" required>
                                                        <option value="">Pilih...</option>
                                                        <option value="1">Tidak sama sekali</option>
                                                        <option value="2">Kecil</option>
                                                        <option value="3">Sedang</option>
                                                        <option value="4">Besar</option>
                                                        <option value="5">Sangat besar</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q49">49. Jika anda mendapatkan kesempatan untuk kembali ke masa lalu, apakah anda akan tetap memilih UIN SUSKA RIAU sebagai tempat kuliah?(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q49" id="q49" required onchange="toggleadd49(this.value)">
                                                        <option value="">Pilih...</option>
                                                        <option value="1">Ya</option>
                                                        <option value="2">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 hidden" id="kes_pilih2">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q49a">49a. Jika anda tidak memilih UIN SUSKA RIAU kembali sebagai tempat kuliah, apa alasan utamanya(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q49a" id="q49a">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q50">50. Jika anda mendapat kesempatan untuk kembali ke masa lalu, apakah anda akan tetap memilih program studi yang sama(<span class="text-danger">*</span>)</h6>
                                                    <select class="form-select" name="q50" id="q50" required onchange="toggleadd50(this.value)">
                                                        <option value="">Pilih...</option>
                                                        <option value="1">Ya</option>
                                                        <option value="2">Tidak</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 hidden" id="kes_pilih">
                                                    <h6 style="background-color: #ededed; font-weight: normal;" class="form-label p-1" for="q50a">50a. Jika anda tidak memilih program studi yang sama, apa alasan utamanya?(<span class="text-danger">*</span>)</h6>
                                                    <input class="form-control" type="text" name="q50a" id="q50a">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <button type="submit" class="btn float-end my-4" style="background-color: #525252; color:white">Selesai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer>
        <p class="text-center mt-3 text-muted" style="color: white;">© 2024 Kuesioner Alumni UIN SUSKA RIAU</p>
    </footer>
    <script src="../assets/js/script.js"></script>
</body>

</html>