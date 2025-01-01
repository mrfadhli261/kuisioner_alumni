<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>

<body>
    <div>
        <header>
            <nav>
                <div>
                    <a href="">Tracer Study</a>
                </div>
                <div>
                    <?php if ($isLoggedIn): ?>
                        <a href="profile.php"><button type="button">Profil</button></a>
                        <a href="logout.php"><button type="button">Logout</button></a>
                    <?php else: ?>
                        <a href="login.php"><button type="button">Login</button></a>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
    </div>
</body>

</html>