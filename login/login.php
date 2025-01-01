<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
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

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Title above the card -->
            <div class="text-center mb-4">
                <h1><b>Kuesioner Alumni</b></h1>
            </div>
            <!-- Adjusted width to make it narrower -->
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <?php
                        include '../server/db.php';
                        include '../massage/login.php';
                        ?>
                        <h5 class="text-left mb-4">Silahkan masukkan nim Anda untuk melanjutkan</h5>
                        <form action="../auth/login.php" method="post">
                            <!-- Form fields -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" required>
                                <label for="nim">NIM</label>
                            </div>
                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <hr class="my-4">
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='login_admin.php'">Login Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Footer text (optional) -->

                <p class="text-center mt-3 text-muted">© 2024 Kuesioner Alumni UIN SUSKA RIAU</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>