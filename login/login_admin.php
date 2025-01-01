<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            <!-- Single card with a dividing line in the center -->
            <div class="container col-xl-10 col-xxl-8 px-4 py-5">
                <div class="row align-items-center g-lg-5 py-5">
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Kuesioner Alumni</h1>
                        <p class="col-lg-10 fs-4">Dibuat pada 2024 untuk memudahkan melakukan pendataan jenjang karir seperti pekerjaan, karir dan lain sebagainya yang dilakukan oleh alumni</p>
                    </div>
                    <div class="col-md-10 mx-auto col-lg-5">
                        <form action="../auth/login_admin.php" class="p-4 p-md-5 border rounded-3 bg-body-tertiary shadow" method="POST">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold"><b>Kuesioner Alumni</b></h2>
                                <p class="text-muted">Silahkan login untuk masuk admin</p>
                                <hr class="my-4">
                            </div>
                            <div class="container-full">
                                <div class="form-floating mb-3">
                                    <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                                <hr class="my-4">
                            </div>
                        </form>
                    </div>

                </div>
                <p class="text-center text-muted">© 2024 Kuesioner Alumni UIN SUSKA RIAU</p>
            </div>
            <!-- Footer text (optional) -->
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>