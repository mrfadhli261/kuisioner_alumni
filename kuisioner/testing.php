<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div>
        <header>
            <div>
            </div>
        </header>
    </div>
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="container mt-5">
            <section class="content">
                <div class="card">
                    <div class="content-header">
                        <div class="flex-col">
                            <div class="d-md-flex align-items-center justify-content-center text-center">
                                <h4 class="text-center mb-5 mt-5">Form Tracer Study UIN SUSKA RIAU</h4>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <form action="process.php" method="POST">
                                <div class="container">
                                    <!-- Data Diri -->
                                    <div id="data_diri" class="card">
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
                                        <div class="card-header">
                                            <h4 class="mb-0">A. Data Pribadi</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="nama">1. Nama :</label>
                                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= htmlspecialchars($alumni['nama']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="nim">2. Nim :</label>
                                                    <input type="text" class="form-control" name="nim" id="nim" value="<?= htmlspecialchars($alumni['nim']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="angkatan">3. Angkatan :</label>
                                                    <input type="text" class="form-control" name="angkatan" id="angkatan" value="<?= htmlspecialchars($alumni['angkatan']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="prodi_id">4. Program Studi :</label>
                                                    <input class="form-control" type="text" name="prodi_id" id="prodi_id" value="<?= htmlspecialchars($alumni['nama_prodi']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="ipk">5. IPK :</label>
                                                    <input class="form-control" type="text" name="ipk" id="ipk" value="<?= htmlspecialchars($alumni['ipk']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="lulus">6. Lulus :</label>
                                                    <input class="form-control" type="text" name="lulus" id="lulus" value="<?= htmlspecialchars($alumni['lulus']); ?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="alamat">7. Alamat :</label>
                                                    <input class="form-control" type="text" name="alamat" id="alamat" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="provinsi">8. Provinsi :</label>
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
                                                    <label class="form-label" for="kabupaten">9. Kota/Kabupaten</label>
                                                    <select class="form-select" name="kabupaten" id="kabupaten" required>
                                                        <option value="">Pilih...</option> <!-- Tambahkan opsi default -->
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="kode_pos">10. Kode Pos :</label>
                                                    <input class="form-control" type="text" name="kode_pos" id="kode_pos" required oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="nomor_hp">11. Telepon :</label>
                                                    <input class="form-control" type="text" name="nomor_hp" id="nomor_hp" required oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka, spasi, atau tanda + (8-20 karakter).</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="email">12. Email :</label>
                                                    <input class="form-control" type="email" name="email" id="email" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="jenis_kelamin">13. Jenis Kelamin :</label>
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
                                    <div id="status_kerja" class="card mt-3">
                                        <div class="card-body">
                                            <div class="row g-3 ">
                                                <label class="form-label mb-0 w-25 mx-3" for="q13a">Apakah Anda sudah bekerja?*:</label>
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
                                    <div id="pekerjaan_section" class="hidden card mt-3">
                                        <div class="card-header">
                                            <h4 class="mb-0">B. Pekerjaan Saat Ini</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q14">14. Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang</label>
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

                                                <div class="col-md-6 d-flex align-items-center" id="kerja_lainnya" class="col-md-6 d-flex align-items-center hidden">
                                                    <label class="form-label mb-0 w-25 mx-3" for=" q14a">14a. Jenis pekerjaan lainnya</label>
                                                    <input class="form-control" name="q14a" id="q14a" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q15a">15a. Nama Kantor</label>
                                                    <input class="form-control" name="q15a" id="q15a" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q15b">15b. Nama Pimpinan</label>
                                                    <input class="form-control" name="q15b" id="q15b" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q15c">15c. Email Pimpinan</label>
                                                    <input class="form-control" name="q15c" id="q15c" type="email">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q16">16. Pekerjaan saat ini bergerak di bidang?</label>
                                                    <input class="form-control" name="q16" id="q16" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q17">17. Tahun mulai kerja</label>
                                                    <input class="form-control" name="q17" id="q17" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q18">18. No. Telepon/HP Pimpinan</label>
                                                    <input class="form-control" name="q18" id="q18" type="text" oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                                    <small>Masukkan hanya angka, spasi, atau tanda + (8-20 karakter).</small>
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q19">19. Website Kantor</label>
                                                    <input class="form-control" name="q19" id="q19" type="url">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q20">20. Alamat Kantor Perusahaan</label>
                                                    <input class="form-control" name="q20" id="q20" type="text">
                                                </div>

                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q21">21. Penghasilan Per bulan saat ini</label>
                                                    <select class="form-select" name="q21" id="q21">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah Rp. 1.000.000,-</option>
                                                        <option value="2">Antara Rp. 1.000.000,--Rp. 1.500.000,-</option>
                                                        <option value="3">Antara Rp. 3.000.000,--Rp. 5.000.000,-</option>
                                                        <option value="4">Diatas Rp. 5.000.000,-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q22">22. Status Pekerjaan</label>
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
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q23">23. Menurut anda apakah pekerjaan anda saat ini berhubungan dengan program studi anda?</label>
                                                    <select class="form-select" name="q23" id="q23">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Rendah</option>
                                                        <option value="2">Sedang</option>
                                                        <option value="3">Tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q24">24. Kapan anda mendapatkan perkerjaan saat ini?</label>
                                                    <select class="form-select" name="q24" id="q24">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Dibawah tiga bulan setelah lulus kuliah</option>
                                                        <option value="2">3-6 bulan setelah lulus kuliah</option>
                                                        <option value="3">6-18 bulan setelah lulus kuliah</option>
                                                        <option value="4">diatas 18 bulan setelah lulus kuliah</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q25">25. Tingkat pendidikan apa yang paling tepat/sesuai dengan pekerjaan anda saat ini</label>
                                                    <select class="form-select" name="q25" id="q25">
                                                        <option value="">pilih...</option>
                                                        <option value="1">Setingkat lebih Tinggi</option>
                                                        <option value="2">Tingkat yang sama</option>
                                                        <option value="3">Setingkat lebih rendah</option>
                                                        <option value="4">Tidak perlu pendidikan tinggi</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <label class="form-label mb-0 w-25 mx-3" for="q25a">Apakah ini perkerjaan pertama setelah lulus</label>
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

                                <!-- pekerjaan pertama -->
                                <div id="pekerjaan_pertama" class="hidden card mt-3">
                                    <div class="card-header">
                                        <h4 class="mb-0">Pekerjaan Pertama</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q26">26. Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang</label>
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
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q27">27. Nama kantor/perusahaan</label>
                                                <input class="form-control" type="text" name="q27" id="q27">
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q28">28. Alasan anda pindah atau berhenti dari pekerjaan sebelumnya</label>
                                                <input class="form-control" type="text" name="q28" id="q28">
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q29">29. Alamat kantor</label>
                                                <input class="form-control" type="text" name="q29" id="q29">
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q30">30. Gaji pertama</label>
                                                <select class="form-select" name="q30" id="q30">
                                                    <option value="">pilih...</option>
                                                    <option value="1">Dibawah Rp. 1.000.000,-</option>
                                                    <option value="2">Antara Rp. 1.000.000,--Rp. 1.500.000,-</option>
                                                    <option value="3">Antara Rp. 3.000.000,--Rp. 5.000.000,-</option>
                                                    <option value="4">Diatas Rp. 5.000.000,-</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q31">31. Lama Bekerja (dalam bulan)</label>
                                                <input class="form-control" type="number" name="q31" id="q31">
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q32">32. Menurut anda apakah pekerjaan anda berhubungan dengan program studi anda</label>
                                                <select class="form-select" name="q32" id="q32">
                                                    <option value="">pilih...</option>
                                                    <option value="1">Rendah</option>
                                                    <option value="2">Sedang</option>
                                                    <option value="3">Tinggi</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q33">33. Kapan anda mendapatkan perkerjaan saat ini?</label>
                                                <select class="form-select" name="q33" id="q33">
                                                    <option value="">pilih...</option>
                                                    <option value="1">Dibawah tiga bulan setelah lulus kuliah</option>
                                                    <option value="2">3-6 bulan setelah lulus kuliah</option>
                                                    <option value="3">6-18 bulan setelah lulus kuliah</option>
                                                    <option value="4">diatas 18 bulan setelah lulus kuliah</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q34">34. Status Pekerjaan</label>
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

                                <!-- Kegiatan Pendidikan dan Pengalaman Pembelajaran -->
                                <div id="pengalaman_section" class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="mb-0">C. Kegiatan Pendidikan dan Pengalaman Pembelajaran</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q35">35. Selama kuliah, kebanyakan anda tinggal di?</label>
                                                <select class="form-select" name="q35" id="q35" required>
                                                    <option value="">pilih...</option>
                                                    <option value="1">Sendiri di tempat kos</option>
                                                    <option value="2">Bersama orang tua</option>
                                                    <option value="3">Bersama saudara</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q36">36. Siapa yang terutama membayara kuliah andaa</label>
                                                <select class="form-select" name="q36" id="q36" required>
                                                    <option value="">pilih...</option>
                                                    <option value="1">Beasiswa(dari pemerintah/sekolah/yayasan)</option>
                                                    <option value="2">sebagian beasiswa</option>
                                                    <option value="3">orangtua/saudara</option>
                                                    <option value="4">biaya sendiri</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q37">37. Selama kuliah apakah anda menjadi anggota dari suatu organisasi baik di dalam atau di luar kampus</label>
                                                <select class="form-select" name="q37" id="q37" required onchange="toggleadd37(this.value)">
                                                    <option value="">pilih...</option>
                                                    <option value="1">Ya</option>
                                                    <option value="2">Tidak</option>
                                                </select>
                                            </div>
                                            <div id="aktif_org" class="hidden">
                                                <label class="form-label mb-0 w-25 mx-3" for="q38">38. Seberapa aktif anda di organisasi tersebut</label>
                                                <select class="form-select" name="q38" id="q38">
                                                    <option value="">pilih...</option>
                                                    <option value="1">pasif</option>
                                                    <option value="2">cukup aktif</option>
                                                    <option value="3">sedang aktig</option>
                                                    <option value="4">sangat aktig</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q39">39. Pada saat anda kuliah di perguruan tinggi, apakah anda mengambil kursus atau perndidikan tambahan</label>
                                                <select class="form-select" name="q39" id="q39" required onchange="toggleadd39(this.value)">
                                                    <option value="">pilih...</option>
                                                    <option value="1">ya</option>
                                                    <option value="2">tidak</option>
                                                </select>
                                            </div>
                                            <div id="kursus_apa" class="hidden">
                                                <label class="form-label mb-0 w-25 mx-3" for="q39a">39a. Kursus apa yang anda ambil untuk pendidikan tambahan</label>
                                                <input class="form-control" type="text" name="q39a" id="q39a">
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>40. Menurut anda, seberapa besar penekanan pada aspek-aspek pembelejaran di bawah ini dilaksanakan di program studi anda</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>40a. Perkuliahan</td>
                                                            <td><input type="radio" name="q40a" value="1" required></td>
                                                            <td><input type="radio" name="q40a" value="2" required></td>
                                                            <td><input type="radio" name="q40a" value="3" required></td>
                                                            <td><input type="radio" name="q40a" value="4" required></td>
                                                            <td><input type="radio" name="q40a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>40b. Demonstrasi (Praktek)</td>
                                                            <td><input type="radio" name="q40b" value="1" required></td>
                                                            <td><input type="radio" name="q40b" value="2" required></td>
                                                            <td><input type="radio" name="q40b" value="3" required></td>
                                                            <td><input type="radio" name="q40b" value="4" required></td>
                                                            <td><input type="radio" name="q40b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>40c. Partisipasi dalam riset</td>
                                                            <td><input type="radio" name="q40c" value="1" required></td>
                                                            <td><input type="radio" name="q40c" value="2" required></td>
                                                            <td><input type="radio" name="q40c" value="3" required></td>
                                                            <td><input type="radio" name="q40c" value="4" required></td>
                                                            <td><input type="radio" name="q40c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>40d. Diskusi</td>
                                                            <td><input type="radio" name="q40d" value="1" required></td>
                                                            <td><input type="radio" name="q40d" value="2" required></td>
                                                            <td><input type="radio" name="q40d" value="3" required></td>
                                                            <td><input type="radio" name="q40d" value="4" required></td>
                                                            <td><input type="radio" name="q40d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>40e. Praktek Kerja Lapangan</td>
                                                            <td><input type="radio" name="q40e" value="1" required></td>
                                                            <td><input type="radio" name="q40e" value="2" required></td>
                                                            <td><input type="radio" name="q40e" value="3" required></td>
                                                            <td><input type="radio" name="q40e" value="4" required></td>
                                                            <td><input type="radio" name="q40e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>40f. Seminar / Workshop</td>
                                                            <td><input type="radio" name="q40f" value="1" required></td>
                                                            <td><input type="radio" name="q40f" value="2" required></td>
                                                            <td><input type="radio" name="q40f" value="3" required></td>
                                                            <td><input type="radio" name="q40f" value="4" required></td>
                                                            <td><input type="radio" name="q40f" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: left;">41. Bagaimana penilaian anda terhadap aspek belajar mengajar di bawah ini </th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>41a. Kesempatan untuk berinteraksi dengan dosen-dosen di luar jadwal kuliah</td>
                                                            <td><input type="radio" name="q41a" value="1" required></td>
                                                            <td><input type="radio" name="q41a" value="2" required></td>
                                                            <td><input type="radio" name="q41a" value="3" required></td>
                                                            <td><input type="radio" name="q41a" value="4" required></td>
                                                            <td><input type="radio" name="q41a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>41b. pembimbingan akademik</td>
                                                            <td><input type="radio" name="q41b" value="1" required></td>
                                                            <td><input type="radio" name="q41b" value="2" required></td>
                                                            <td><input type="radio" name="q41b" value="3" required></td>
                                                            <td><input type="radio" name="q41b" value="4" required></td>
                                                            <td><input type="radio" name="q41b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>41c. kesempatan berpartisipasi dalam proyek riset</td>
                                                            <td><input type="radio" name="q41c" value="1" required></td>
                                                            <td><input type="radio" name="q41c" value="2" required></td>
                                                            <td><input type="radio" name="q41c" value="3" required></td>
                                                            <td><input type="radio" name="q41c" value="4" required></td>
                                                            <td><input type="radio" name="q41c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>41d. kondisi umum belajar mengajar</td>
                                                            <td><input type="radio" name="q41d" value="1" required></td>
                                                            <td><input type="radio" name="q41d" value="2" required></td>
                                                            <td><input type="radio" name="q41d" value="3" required></td>
                                                            <td><input type="radio" name="q41d" value="4" required></td>
                                                            <td><input type="radio" name="q41d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>41e. kesempatan untuk memasuki dan menjadi bagian dari jejaring ilmiah professional</td>
                                                            <td><input type="radio" name="q41e" value="1" required></td>
                                                            <td><input type="radio" name="q41e" value="2" required></td>
                                                            <td><input type="radio" name="q41e" value="3" required></td>
                                                            <td><input type="radio" name="q41e" value="4" required></td>
                                                            <td><input type="radio" name="q41e" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>42. Bagaimana penilaian anda terhadap kondisi fasilitas belajar dibawah ini</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>42a. Perpustakaan</td>
                                                            <td><input type="radio" name="q42a" value="1" required></td>
                                                            <td><input type="radio" name="q42a" value="2" required></td>
                                                            <td><input type="radio" name="q42a" value="3" required></td>
                                                            <td><input type="radio" name="q42a" value="4" required></td>
                                                            <td><input type="radio" name="q42a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42b. Teknologi informasi dan komunikasi</td>
                                                            <td><input type="radio" name="q42b" value="1" required></td>
                                                            <td><input type="radio" name="q42b" value="2" required></td>
                                                            <td><input type="radio" name="q42b" value="3" required></td>
                                                            <td><input type="radio" name="q42b" value="4" required></td>
                                                            <td><input type="radio" name="q42b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42c. Modul belajar</td>
                                                            <td><input type="radio" name="q42c" value="1" required></td>
                                                            <td><input type="radio" name="q42c" value="2" required></td>
                                                            <td><input type="radio" name="q42c" value="3" required></td>
                                                            <td><input type="radio" name="q42c" value="4" required></td>
                                                            <td><input type="radio" name="q42c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42d. Ruang belajar</td>
                                                            <td><input type="radio" name="q42d" value="1" required></td>
                                                            <td><input type="radio" name="q42d" value="2" required></td>
                                                            <td><input type="radio" name="q42d" value="3" required></td>
                                                            <td><input type="radio" name="q42d" value="4" required></td>
                                                            <td><input type="radio" name="q42d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42e. Laboratorium</td>
                                                            <td><input type="radio" name="q42e" value="1" required></td>
                                                            <td><input type="radio" name="q42e" value="2" required></td>
                                                            <td><input type="radio" name="q42e" value="3" required></td>
                                                            <td><input type="radio" name="q42e" value="4" required></td>
                                                            <td><input type="radio" name="q42e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42f. Variasi mata kuliah yang ditawarkan</td>
                                                            <td><input type="radio" name="q42f" value="1" required></td>
                                                            <td><input type="radio" name="q42f" value="2" required></td>
                                                            <td><input type="radio" name="q42f" value="3" required></td>
                                                            <td><input type="radio" name="q42f" value="4" required></td>
                                                            <td><input type="radio" name="q42f" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42g. Kantin</td>
                                                            <td><input type="radio" name="q42g" value="1" required></td>
                                                            <td><input type="radio" name="q42g" value="2" required></td>
                                                            <td><input type="radio" name="q42g" value="3" required></td>
                                                            <td><input type="radio" name="q42g" value="4" required></td>
                                                            <td><input type="radio" name="q42g" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42h. Unit kegiatan mahasiswa dan fasilitasnya</td>
                                                            <td><input type="radio" name="q42h" value="1" required></td>
                                                            <td><input type="radio" name="q42h" value="2" required></td>
                                                            <td><input type="radio" name="q42h" value="3" required></td>
                                                            <td><input type="radio" name="q42h" value="4" required></td>
                                                            <td><input type="radio" name="q42h" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42i. Fasilitas layanan kesehatan</td>
                                                            <td><input type="radio" name="q42i" value="1" required></td>
                                                            <td><input type="radio" name="q42i" value="2" required></td>
                                                            <td><input type="radio" name="q42i" value="3" required></td>
                                                            <td><input type="radio" name="q42i" value="4" required></td>
                                                            <td><input type="radio" name="q42i" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42j. Toilet</td>
                                                            <td><input type="radio" name="q42j" value="1" required></td>
                                                            <td><input type="radio" name="q42j" value="2" required></td>
                                                            <td><input type="radio" name="q42j" value="3" required></td>
                                                            <td><input type="radio" name="q42j" value="4" required></td>
                                                            <td><input type="radio" name="q42j" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42k. Masjid</td>
                                                            <td><input type="radio" name="q42k" value="1" required></td>
                                                            <td><input type="radio" name="q42k" value="2" required></td>
                                                            <td><input type="radio" name="q42k" value="3" required></td>
                                                            <td><input type="radio" name="q42k" value="4" required></td>
                                                            <td><input type="radio" name="q42k" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>43. Bagaimana penilaian anda terhadap pengalaman belajar dibawah ini</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>43a. Pembelajaran di kelas</td>
                                                            <td><input type="radio" name="q43a" value="1" required></td>
                                                            <td><input type="radio" name="q43a" value="2" required></td>
                                                            <td><input type="radio" name="q43a" value="3" required></td>
                                                            <td><input type="radio" name="q43a" value="4" required></td>
                                                            <td><input type="radio" name="q43a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43b. Praktikum / Praktek kerja lapangan</td>
                                                            <td><input type="radio" name="q43b" value="1" required></td>
                                                            <td><input type="radio" name="q43b" value="2" required></td>
                                                            <td><input type="radio" name="q43b" value="3" required></td>
                                                            <td><input type="radio" name="q43b" value="4" required></td>
                                                            <td><input type="radio" name="q43b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43c. Pengabdian pada masyarakat</td>
                                                            <td><input type="radio" name="q43c" value="1" required></td>
                                                            <td><input type="radio" name="q43c" value="2" required></td>
                                                            <td><input type="radio" name="q43c" value="3" required></td>
                                                            <td><input type="radio" name="q43c" value="4" required></td>
                                                            <td><input type="radio" name="q43c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43d. Penulisan tugas akhir/Proyek akhir</td>
                                                            <td><input type="radio" name="q43d" value="1" required></td>
                                                            <td><input type="radio" name="q43d" value="2" required></td>
                                                            <td><input type="radio" name="q43d" value="3" required></td>
                                                            <td><input type="radio" name="q43d" value="4" required></td>
                                                            <td><input type="radio" name="q43d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43e. Organisasi kemahasiswaan</td>
                                                            <td><input type="radio" name="q43e" value="1" required></td>
                                                            <td><input type="radio" name="q43e" value="2" required></td>
                                                            <td><input type="radio" name="q43e" value="3" required></td>
                                                            <td><input type="radio" name="q43e" value="4" required></td>
                                                            <td><input type="radio" name="q43e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43f. Kegiatan kemahasiswaan</td>
                                                            <td><input type="radio" name="q43f" value="1" required></td>
                                                            <td><input type="radio" name="q43f" value="2" required></td>
                                                            <td><input type="radio" name="q43f" value="3" required></td>
                                                            <td><input type="radio" name="q43f" value="4" required></td>
                                                            <td><input type="radio" name="q43f" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>43g. Olahraga</td>
                                                            <td><input type="radio" name="q43g" value="1" required></td>
                                                            <td><input type="radio" name="q43g" value="2" required></td>
                                                            <td><input type="radio" name="q43g" value="3" required></td>
                                                            <td><input type="radio" name="q43g" value="4" required></td>
                                                            <td><input type="radio" name="q43g" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- tingkat kompetensi -->
                                <div id="tingkat_kompetensi">
                                    <div>
                                        <div class="row g-3">
                                            <h4>C. Tingkat Kompetensi alumni</h4>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>44. Pada saat lulus, pada tingkat mana kompetensi dibawah ini yang anda kuasai</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>44a. Pengetahuan di bidang atau disiplin ilmu anda</td>
                                                            <td><input type="radio" name="q44a" value="1" required></td>
                                                            <td><input type="radio" name="q44a" value="2" required></td>
                                                            <td><input type="radio" name="q44a" value="3" required></td>
                                                            <td><input type="radio" name="q44a" value="4" required></td>
                                                            <td><input type="radio" name="q44a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44b. Pengetahuan di luar bidang atau disiplin ilmu anda</td>
                                                            <td><input type="radio" name="q44b" value="1" required></td>
                                                            <td><input type="radio" name="q44b" value="2" required></td>
                                                            <td><input type="radio" name="q44b" value="3" required></td>
                                                            <td><input type="radio" name="q44b" value="4" required></td>
                                                            <td><input type="radio" name="q44b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44c. Pengetahuan alam</td>
                                                            <td><input type="radio" name="q44c" value="1" required></td>
                                                            <td><input type="radio" name="q44c" value="2" required></td>
                                                            <td><input type="radio" name="q44c" value="3" required></td>
                                                            <td><input type="radio" name="q44c" value="4" required></td>
                                                            <td><input type="radio" name="q44c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44d. Keterampilan internet</td>
                                                            <td><input type="radio" name="q44d" value="1" required></td>
                                                            <td><input type="radio" name="q44d" value="2" required></td>
                                                            <td><input type="radio" name="q44d" value="3" required></td>
                                                            <td><input type="radio" name="q44d" value="4" required></td>
                                                            <td><input type="radio" name="q44d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44e. Keterampilan komputer</td>
                                                            <td><input type="radio" name="q44e" value="1" required></td>
                                                            <td><input type="radio" name="q44e" value="2" required></td>
                                                            <td><input type="radio" name="q44e" value="3" required></td>
                                                            <td><input type="radio" name="q44e" value="4" required></td>
                                                            <td><input type="radio" name="q44e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44f. Berpikir kritis</td>
                                                            <td><input type="radio" name="q44f" value="1" required></td>
                                                            <td><input type="radio" name="q44f" value="2" required></td>
                                                            <td><input type="radio" name="q44f" value="3" required></td>
                                                            <td><input type="radio" name="q44f" value="4" required></td>
                                                            <td><input type="radio" name="q44f" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44g. Keterampilan riset</td>
                                                            <td><input type="radio" name="q44g" value="1" required></td>
                                                            <td><input type="radio" name="q44g" value="2" required></td>
                                                            <td><input type="radio" name="q44g" value="3" required></td>
                                                            <td><input type="radio" name="q44g" value="4" required></td>
                                                            <td><input type="radio" name="q44g" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44h. Kemampuan belajar</td>
                                                            <td><input type="radio" name="q44h" value="1" required></td>
                                                            <td><input type="radio" name="q44h" value="2" required></td>
                                                            <td><input type="radio" name="q44h" value="3" required></td>
                                                            <td><input type="radio" name="q44h" value="4" required></td>
                                                            <td><input type="radio" name="q44h" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44i. Kemampuan berkomunikasi</td>
                                                            <td><input type="radio" name="q44i" value="1" required></td>
                                                            <td><input type="radio" name="q44i" value="2" required></td>
                                                            <td><input type="radio" name="q44i" value="3" required></td>
                                                            <td><input type="radio" name="q44i" value="4" required></td>
                                                            <td><input type="radio" name="q44i" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44j. Manajemen waktu</td>
                                                            <td><input type="radio" name="q44j" value="1" required></td>
                                                            <td><input type="radio" name="q44j" value="2" required></td>
                                                            <td><input type="radio" name="q44j" value="3" required></td>
                                                            <td><input type="radio" name="q44j" value="4" required></td>
                                                            <td><input type="radio" name="q44j" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44k. Bekerja secara mandiri</td>
                                                            <td><input type="radio" name="q44k" value="1" required></td>
                                                            <td><input type="radio" name="q44k" value="2" required></td>
                                                            <td><input type="radio" name="q44k" value="3" required></td>
                                                            <td><input type="radio" name="q44k" value="4" required></td>
                                                            <td><input type="radio" name="q44k" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44l. Bekerja dalam tim/bekerja sama dengan orng lain</td>
                                                            <td><input type="radio" name="q44l" value="1" required></td>
                                                            <td><input type="radio" name="q44l" value="2" required></td>
                                                            <td><input type="radio" name="q44l" value="3" required></td>
                                                            <td><input type="radio" name="q44l" value="4" required></td>
                                                            <td><input type="radio" name="q44l" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44m. Kemampuan dalam memecahkan masalah</td>
                                                            <td><input type="radio" name="q44m" value="1" required></td>
                                                            <td><input type="radio" name="q44m" value="2" required></td>
                                                            <td><input type="radio" name="q44m" value="3" required></td>
                                                            <td><input type="radio" name="q44m" value="4" required></td>
                                                            <td><input type="radio" name="q44m" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44n. Kemampuan analisis</td>
                                                            <td><input type="radio" name="q44n" value="1" required></td>
                                                            <td><input type="radio" name="q44n" value="2" required></td>
                                                            <td><input type="radio" name="q44n" value="3" required></td>
                                                            <td><input type="radio" name="q44n" value="4" required></td>
                                                            <td><input type="radio" name="q44n" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44o. Kemampuan dalam memegang tanggung jawab</td>
                                                            <td><input type="radio" name="q44o" value="1" required></td>
                                                            <td><input type="radio" name="q44o" value="2" required></td>
                                                            <td><input type="radio" name="q44o" value="3" required></td>
                                                            <td><input type="radio" name="q44o" value="4" required></td>
                                                            <td><input type="radio" name="q44o" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44p. Manajemen proyek/program</td>
                                                            <td><input type="radio" name="q44p" value="1" required></td>
                                                            <td><input type="radio" name="q44p" value="2" required></td>
                                                            <td><input type="radio" name="q44p" value="3" required></td>
                                                            <td><input type="radio" name="q44p" value="4" required></td>
                                                            <td><input type="radio" name="q44p" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44q. Kemampuan untuk mempresentasikan ide/produk/laporan</td>
                                                            <td><input type="radio" name="q44q" value="1" required></td>
                                                            <td><input type="radio" name="q44q" value="2" required></td>
                                                            <td><input type="radio" name="q44q" value="3" required></td>
                                                            <td><input type="radio" name="q44q" value="4" required></td>
                                                            <td><input type="radio" name="q44q" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>44r. Kemampuan dalam menuliskan laporan, memo, dokumen</td>
                                                            <td><input type="radio" name="q44r" value="1" required></td>
                                                            <td><input type="radio" name="q44r" value="2" required></td>
                                                            <td><input type="radio" name="q44r" value="3" required></td>
                                                            <td><input type="radio" name="q44r" value="4" required></td>
                                                            <td><input type="radio" name="q44r" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>45. Sejauh mana program studi anda bermanfaat untuk hal-hal dibawah ini?</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>45a. Memulai pekerjaan</td>
                                                            <td><input type="radio" name="q45a" value="1" required></td>
                                                            <td><input type="radio" name="q45a" value="2" required></td>
                                                            <td><input type="radio" name="q45a" value="3" required></td>
                                                            <td><input type="radio" name="q45a" value="4" required></td>
                                                            <td><input type="radio" name="q45a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>45b. Pembelajaran lanjut dalam pekerjaan</td>
                                                            <td><input type="radio" name="q45b" value="1" required></td>
                                                            <td><input type="radio" name="q45b" value="2" required></td>
                                                            <td><input type="radio" name="q45b" value="3" required></td>
                                                            <td><input type="radio" name="q45b" value="4" required></td>
                                                            <td><input type="radio" name="q45b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>45c. Kinerja dalam menjalankan tugas</td>
                                                            <td><input type="radio" name="q45c" value="1" required></td>
                                                            <td><input type="radio" name="q45c" value="2" required></td>
                                                            <td><input type="radio" name="q45c" value="3" required></td>
                                                            <td><input type="radio" name="q45c" value="4" required></td>
                                                            <td><input type="radio" name="q45c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>45d. Karir di masa depan</td>
                                                            <td><input type="radio" name="q45d" value="1" required></td>
                                                            <td><input type="radio" name="q45d" value="2" required></td>
                                                            <td><input type="radio" name="q45d" value="3" required></td>
                                                            <td><input type="radio" name="q45d" value="4" required></td>
                                                            <td><input type="radio" name="q45d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>45e. Pengembangan diri</td>
                                                            <td><input type="radio" name="q45e" value="1" required></td>
                                                            <td><input type="radio" name="q45e" value="2" required></td>
                                                            <td><input type="radio" name="q45e" value="3" required></td>
                                                            <td><input type="radio" name="q45e" value="4" required></td>
                                                            <td><input type="radio" name="q45e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>45f. Meningkatkan keterampilan kewirausahaan</td>
                                                            <td><input type="radio" name="q45f" value="1" required></td>
                                                            <td><input type="radio" name="q45f" value="2" required></td>
                                                            <td><input type="radio" name="q45f" value="3" required></td>
                                                            <td><input type="radio" name="q45f" value="4" required></td>
                                                            <td><input type="radio" name="q45f" value="5" required></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>46. Seberapa besar peran kompetensi yang diperoleh di perguruan tinggi berikut ini dalam melaksanakaan pekerjaan anda</th>
                                                            <th>Sangat Buruk</th>
                                                            <th>Buruk</th>
                                                            <th>Sedang</th>
                                                            <th>Baik</th>
                                                            <th>Sangat Baik</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>46a. Pengetahuan di bidang atau disiplin ilmu anda</td>
                                                            <td><input type="radio" name="q46a" value="1" required></td>
                                                            <td><input type="radio" name="q46a" value="2" required></td>
                                                            <td><input type="radio" name="q46a" value="3" required></td>
                                                            <td><input type="radio" name="q46a" value="4" required></td>
                                                            <td><input type="radio" name="q46a" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46b. Pengetahuan di luar bidang atau disiplin ilmu anda</td>
                                                            <td><input type="radio" name="q46b" value="1" required></td>
                                                            <td><input type="radio" name="q46b" value="2" required></td>
                                                            <td><input type="radio" name="q46b" value="3" required></td>
                                                            <td><input type="radio" name="q46b" value="4" required></td>
                                                            <td><input type="radio" name="q46b" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46c. Pengetahuan alam</td>
                                                            <td><input type="radio" name="q46c" value="1" required></td>
                                                            <td><input type="radio" name="q46c" value="2" required></td>
                                                            <td><input type="radio" name="q46c" value="3" required></td>
                                                            <td><input type="radio" name="q46c" value="4" required></td>
                                                            <td><input type="radio" name="q46c" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46d. Keterampilan internet</td>
                                                            <td><input type="radio" name="q46d" value="1" required></td>
                                                            <td><input type="radio" name="q46d" value="2" required></td>
                                                            <td><input type="radio" name="q46d" value="3" required></td>
                                                            <td><input type="radio" name="q46d" value="4" required></td>
                                                            <td><input type="radio" name="q46d" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46e. Keterampilan komputer</td>
                                                            <td><input type="radio" name="q46e" value="1" required></td>
                                                            <td><input type="radio" name="q46e" value="2" required></td>
                                                            <td><input type="radio" name="q46e" value="3" required></td>
                                                            <td><input type="radio" name="q46e" value="4" required></td>
                                                            <td><input type="radio" name="q46e" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46f. Berpikir kritis</td>
                                                            <td><input type="radio" name="q46f" value="1" required></td>
                                                            <td><input type="radio" name="q46f" value="2" required></td>
                                                            <td><input type="radio" name="q46f" value="3" required></td>
                                                            <td><input type="radio" name="q46f" value="4" required></td>
                                                            <td><input type="radio" name="q46f" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46g. Keterampilan riset</td>
                                                            <td><input type="radio" name="q46g" value="1" required></td>
                                                            <td><input type="radio" name="q46g" value="2" required></td>
                                                            <td><input type="radio" name="q46g" value="3" required></td>
                                                            <td><input type="radio" name="q46g" value="4" required></td>
                                                            <td><input type="radio" name="q46g" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46h. Kemampuan belajar</td>
                                                            <td><input type="radio" name="q46h" value="1" required></td>
                                                            <td><input type="radio" name="q46h" value="2" required></td>
                                                            <td><input type="radio" name="q46h" value="3" required></td>
                                                            <td><input type="radio" name="q46h" value="4" required></td>
                                                            <td><input type="radio" name="q46h" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46i. Kemampuan berkomunikasi</td>
                                                            <td><input type="radio" name="q46i" value="1" required></td>
                                                            <td><input type="radio" name="q46i" value="2" required></td>
                                                            <td><input type="radio" name="q46i" value="3" required></td>
                                                            <td><input type="radio" name="q46i" value="4" required></td>
                                                            <td><input type="radio" name="q46i" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46j. Manajemen waktu</td>
                                                            <td><input type="radio" name="q46j" value="1" required></td>
                                                            <td><input type="radio" name="q46j" value="2" required></td>
                                                            <td><input type="radio" name="q46j" value="3" required></td>
                                                            <td><input type="radio" name="q46j" value="4" required></td>
                                                            <td><input type="radio" name="q46j" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46k. Bekerja secara mandiri</td>
                                                            <td><input type="radio" name="q46k" value="1" required></td>
                                                            <td><input type="radio" name="q46k" value="2" required></td>
                                                            <td><input type="radio" name="q46k" value="3" required></td>
                                                            <td><input type="radio" name="q46k" value="4" required></td>
                                                            <td><input type="radio" name="q46k" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>42l. Bekerja dalam tim/bekerja sama dengan orng lain</td>
                                                            <td><input type="radio" name="q46l" value="1" required></td>
                                                            <td><input type="radio" name="q46l" value="2" required></td>
                                                            <td><input type="radio" name="q46l" value="3" required></td>
                                                            <td><input type="radio" name="q46l" value="4" required></td>
                                                            <td><input type="radio" name="q46l" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46m. Kemampuan dalam memecahkan masalah</td>
                                                            <td><input type="radio" name="q46m" value="1" required></td>
                                                            <td><input type="radio" name="q46m" value="2" required></td>
                                                            <td><input type="radio" name="q46m" value="3" required></td>
                                                            <td><input type="radio" name="q46m" value="4" required></td>
                                                            <td><input type="radio" name="q46m" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46n. Kemampuan analisis</td>
                                                            <td><input type="radio" name="q46n" value="1" required></td>
                                                            <td><input type="radio" name="q46n" value="2" required></td>
                                                            <td><input type="radio" name="q46n" value="3" required></td>
                                                            <td><input type="radio" name="q46n" value="4" required></td>
                                                            <td><input type="radio" name="q46n" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46o. Kemampuan dalam memegang tanggung jawab</td>
                                                            <td><input type="radio" name="q46o" value="1" required></td>
                                                            <td><input type="radio" name="q46o" value="2" required></td>
                                                            <td><input type="radio" name="q46o" value="3" required></td>
                                                            <td><input type="radio" name="q46o" value="4" required></td>
                                                            <td><input type="radio" name="q46o" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46p. Manajemen proyek/program</td>
                                                            <td><input type="radio" name="q46p" value="1" required></td>
                                                            <td><input type="radio" name="q46p" value="2" required></td>
                                                            <td><input type="radio" name="q46p" value="3" required></td>
                                                            <td><input type="radio" name="q46p" value="4" required></td>
                                                            <td><input type="radio" name="q46p" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46q. Kemampuan untuk mempresentasikan ide/produk/laporan</td>
                                                            <td><input type="radio" name="q46q" value="1" required></td>
                                                            <td><input type="radio" name="q46q" value="2" required></td>
                                                            <td><input type="radio" name="q46q" value="3" required></td>
                                                            <td><input type="radio" name="q46q" value="4" required></td>
                                                            <td><input type="radio" name="q46q" value="5" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td>46r. Kemampuan dalam menuliskan laporan, memo, dokumen</td>
                                                            <td><input type="radio" name="q46r" value="1" required></td>
                                                            <td><input type="radio" name="q46r" value="2" required></td>
                                                            <td><input type="radio" name="q46r" value="3" required></td>
                                                            <td><input type="radio" name="q46r" value="4" required></td>
                                                            <td><input type="radio" name="q46r" value="5" required></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q47">47. Pada saat anda lulus dari perguruan tinggi, bagaimana tingkat kemampuan bahasa asing anda?</label>
                                                <select class="form-select" name="q47" id="q47" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="1">Sangat rendah</option>
                                                    <option value="2">Rendah</option>
                                                    <option value="3">Sedang</option>
                                                    <option value="4">Tinggi</option>
                                                    <option value="5">Sangat Tinggi</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q48">48. Seberapa besar kontribusi perguruan tinggi dalam penguasaan bahasa asing</label>
                                                <select class="form-select" name="q48" id="q48" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="1">Tidak sama sekali</option>
                                                    <option value="2">Kecil</option>
                                                    <option value="3">Sedang</option>
                                                    <option value="4">Besar</option>
                                                    <option value="5">Sangat besar</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q49">49. Jika anda mendapatkan kesempatan untuk kembali ke masa lalu, apakah anda akan tetap memilih UIN SUSKA RIAU sebagai tempat kuliah?</label>
                                                <select class="form-select" name="q49" id="q49" required onchange="toggleadd49(this.value)">
                                                    <option value="">Pilih...</option>
                                                    <option value="1">Ya</option>
                                                    <option value="2">Tidak</option>
                                                </select>
                                            </div>
                                            <div id="kes_pilih2" class="hidden">
                                                <label class="form-label mb-0 w-25 mx-3" for="q49a">49a. Jika anda tidak memilih UIN SUSKA RIAU kembali sebagai tempat kuliah, apa alasan utamanya</label>
                                                <input type="text" name="q49a" id="q49a">
                                            </div>
                                            <div>
                                                <label class="form-label mb-0 w-25 mx-3" for="q50">50. Jika anda mendapat kesempatan untuk kembali ke masa lalu, apakah anda akan tetap memilih program studi yang sama</label>
                                                <select class="form-select" name="q50" id="q50" required onchange="toggleadd50(this.value)">
                                                    <option value="">Pilih...</option>
                                                    <option value="1">Ya</option>
                                                    <option value="2">Tidak</option>
                                                </select>
                                            </div>
                                            <div id="kes_pilih" class="hidden">
                                                <label class="form-label mb-0 w-25 mx-3" for="q50a">50a. Jika anda tidak memilih program studi yang sama, apa alasan utamanya?</label>
                                                <input type="text" name="q50a" id="q50a">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer>
        <p class="text-center mt-3 text-muted">© 2024 Tracer Study UIN SUSKA RIAU</p>
    </footer>
    <script src="../assets/js/script.js"></script>
</body>

</html>