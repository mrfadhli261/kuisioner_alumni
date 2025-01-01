<?php
include 'auth/cek_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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

        /* Menambahkan margin-top untuk menghindari konten tertutup navbar */
        .hero-section {
            background-image: url('https://via.placeholder.com/1200x500');
            /* Ganti dengan gambar kampus */
            background-size: cover;
            background-position: center;
            height: 500px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        .section {
            padding: 50px 0;
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <header class="bg-light shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" style="background-color: white;">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand fw-bold text-black" href="#">Kuesioner Alumni</a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Menu navigasi di tengah -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tutorial">Tutorial</a>
                        </li>
                    </ul>

                    <!-- Login or Profile Dropdown -->
                    <div class="d-flex">
                        <?php if ($isLoggedIn): ?>
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-black" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle fs-4"></i>
                                    <span class="ms-2"><?= htmlspecialchars($userName); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><span class="dropdown-item-text"><?= htmlspecialchars($userName); ?></span></li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="./homepage/homepage.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="./login/login.php" class="btn btn-outline-dark">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="hero-section text-white text-center d-flex justify-content-center align-items-center mt-5 shadow-sm" style="background-image: url('./assets/images/images.jpg'); background-size: cover; height: 500px;">
        <div>
            <h1 class="display-3">Selamat Datang di Kuesioner Alumni</h1>
            <p class="lead">Melacak jejak kesuksesan alumni kami untuk membangun masa depan yang lebih baik.</p>
        </div>
    </div>

    <!-- Tentang Kampus -->
    <div class="container-full" id="tentang">
        <div class="container py-5">
            <h2 class="text-center mb-4 mt-5">Tentang Kuesioner Alumni</h2>
            <div class="row">
                <div class="col-md-6">
                    <p style="text-align: justify;">Kuesioner Alumni adalah inisiatif yang bertujuan untuk melacak lulusan Universitas Islam Negeri Sultan Syarif Kasim Riau, mengetahui perjalanan karir mereka, dan mendapatkan wawasan untuk meningkatkan kualitas pendidikan. Dengan mengumpulkan data dari alumni, kami berkomitmen untuk membangun hubungan yang berkelanjutan antara Universitas Islam Negeri Sultan Syarif Kasim Riau dan lulusannya.
                    <p style="text-align: justify;">Program ini juga bertujuan untuk memberikan informasi relevan kepada mahasiswa baru mengenai peluang karir dan kehidupan setelah kuliah.</p>
                    <?php if (!$isLoggedIn): ?>
                        <a href="./login/login.php" class="btn btn-md px-5 py-3 mt-3 shadow-sm mb-3" style="border-radius: 20px; transition: all 0.3s ease-in-out; background-color: #525252; color: white">
                            Isi Kuisioner
                        </a>
                    <?php else: ?>
                        <a href="./kuisioner/kuisioner.php" class="btn btn-md px-5 py-3 mt-3 shadow-sm mb-3" style="border-radius: 10px; transition: all 0.3s ease-in-out; background-color: #525252; color: white">
                            Isi Kuisioner
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <img src="./assets/images/tracer.jpg" alt="Kuesioner Alumni" class="img-fluid" style="border-radius: 20px;">
                </div>
            </div>
        </div>
    </div>


    <div class="container-full mb-3">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="./assets/images/alumni.jpg" alt="Kuesioner Alumni" class="img-fluid" style="border-radius: 10px;">
                </div>
                <div class="col-md-6">
                    <h3 class="text-left mb-4">Target Kuesioner Alumni</h3>
                    <p style="text-align: justify;">Kuesioner Alumni ini ditargetkan untuk seluruh alumni Universitas Islam Negeri Sultan Syarif Kasim Riau (UIN Suska Riau) yang telah menyelesaikan studi mereka di berbagai program studi dan jenjang pendidikan. Sebagai bagian dari upaya berkelanjutan untuk meningkatkan kualitas pendidikan di UIN Suska Riau, kami mengundang alumni dari berbagai tahun kelulusan untuk berpartisipasi dalam Kuesioner Alumni ini.
                    <p style="text-align: justify;">Survei ini bertujuan untuk melacak perjalanan karir dan perkembangan profesional alumni setelah mereka lulus dari universitas, serta untuk mendapatkan wawasan yang berguna mengenai relevansi dan dampak dari pendidikan yang diterima di dunia kerja.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">Tujuan Kuesioner Alumni</h3>
                <p class="text-justify" style="text-align: justify;">
                    Kuesioner Alumni adalah survei yang bertujuan untuk melacak perjalanan karir dan perkembangan alumni setelah lulus dari perguruan tinggi. Tujuan utamanya meliputi:
                </p>
                <ol>
                    <li style="text-align: justify;">
                        <strong>Menilai Kualitas Pendidikan:</strong> Mengukur relevansi kurikulum dengan kebutuhan dunia kerja.
                    </li>
                    <li style="text-align: justify;">
                        <strong>Mengidentifikasi Kesenjangan Kompetensi:</strong> Mengetahui apakah lulusan memiliki keterampilan yang sesuai dengan tuntutan industri.
                    </li>
                    <li style="text-align: justify;">
                        <strong>Membangun Jaringan Alumni:</strong> Memperkuat hubungan antara alumni dan perguruan tinggi.
                    </li>
                    <li style="text-align: justify;">
                        <strong>Mengukur Penyerapan Lulusan di Dunia Kerja:</strong> Menilai seberapa cepat alumni mendapatkan pekerjaan dan jenis pekerjaan yang mereka jalani.
                    </li>
                    <li style="text-align: justify;">
                        <strong>Meningkatkan Program Pendidikan:</strong> Memberikan masukan untuk pengembangan kurikulum dan layanan karir.
                    </li>
                    <li style="text-align: justify;">
                        <strong>Mendukung Akreditasi:</strong> Menyediakan data untuk proses akreditasi dan evaluasi kinerja perguruan tinggi.
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Tutorial -->
    <div class="container-fluid" id="tutorial">
        <section id="how-to" class="bg-light py-5">
            <div class="container-full">
                <h2 class="text-center mt-5">Cara Mengisi Kuisioner</h2>
                <!-- Baris Pertama: 3 Card -->
                <div class="row mt-4 justify-content-center g-3">
                    <div class="col-md-3 d-flex">
                        <div class="card flex-fill text-center">
                            <div class="card-body">
                                <h5 class="card-title">1. Login/Registrasi</h5>
                                <p class="card-text">Masuk ke sistem menggunakan akun Anda.</p>
                                <img src="./assets/images/login.png" alt="Login Illustration" class="img-fluid mt-2" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="card flex-fill text-center">
                            <div class="card-body">
                                <h5 class="card-title">2. Tekan Tombol isi kuisioner</h5>
                                <p class="card-text">Tombol kuisioner ada di bagian tentang dan juga di dalam profile.</p>
                                <img src="./assets/images/click.png" alt="Data Entry Illustration" class="img-fluid mt-2" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="card flex-fill text-center">
                            <div class="card-body">
                                <h5 class="card-title">3. Jawab Pertanyaan</h5>
                                <p class="card-text">Isi kuesioner sesuai pengalaman Anda.</p>
                                <img src="./assets/images/isi.png" alt="Questionnaire Illustration" class="img-fluid mt-2" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris Kedua: 2 Card -->
                <div class="row mt-4 justify-content-center g-3">
                    <div class="col-md-3 d-flex">
                        <div class="card flex-fill text-center">
                            <div class="card-body">
                                <h5 class="card-title">4. Selesai</h5>
                                <p class="card-text">Periksa kembali apakah semua pertanyaan sudah terisi dan tekan selesai.</p>
                                <img src="./assets/images/selesai.png" alt="Submit Illustration" class="img-fluid mt-2" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="card flex-fill text-center">
                            <div class="card-body">
                                <h5 class="card-title">5. Lihat Profile</h5>
                                <p class="card-text">Anda bisa melakukan pengecekan status kuisioner di bagian profile.</p>
                                <img src="./assets/images/profile.png" alt="Confirmation Illustration" class="img-fluid mt-2" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h3 class="text-left">Kuesioner Alumni</h3>
                <p style="text-align: justify;" class="mt-3">Assalamu'alaikum. Wr. Wb, Seluruh Alumni yang kami hormati, Dengan ini kami mengajukan permohonan kepada Seluruh Alumni untuk berkenan menjadi responden dalam pengisian kuesioner ini. Kuesioner ini berkaitan dengan harapan dan pandangan Seluruh Alumni sebagai pengguna lulusan Universitas Islam Negeri Sultan Syarif Kasim Riau. Kami menjamin bahwa identitas dan tanggapan yang diberikan akan dirahasiakan sepenuhnya. Kami sangat menghargai waktu, perhatian, dan kerja sama Seluruh Alumni. Terima kasih banyak. Wassalamu'alaikum warahmatullahi wabarakatuh.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <?php if (!$isLoggedIn): ?>
                        <a href="./login/login.php" class="btn btn-md px-5 py-3 mt-3 shadow-sm mb-3" style="border-radius: 20px; transition: all 0.3s ease-in-out; background-color: #525252; color: white">
                            Isi Kuisioner
                        </a>
                    <?php else: ?>
                        <a href="./kuisioner/kuisioner.php" class="btn btn-md px-5 py-3 mt-3 shadow-sm mb-3" style="border-radius: 10px; transition: all 0.3s ease-in-out; background-color: #525252; color: white">
                            Isi Kuisioner
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="./assets/images/uin-suska.jpg" alt="" width="720" style="border-radius: 10px;">
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="text-center mt-3" style="color: white;">© 2024 Kuesioner Alumni UIN SUSKA RIAU</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>