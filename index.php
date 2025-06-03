<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointify</title>
    <!-- Font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    require 'navbar.php';
    ?>
    <!-- Main Content -->
    <main>
        <section class="container">
            <div class="horizontal-line"></div>
            <div class="hero-container">
                <div class="main-left-item">
                    <p>Appointify</p>
                    <p>Meet the best doctors today</p>
                    <p>
                        Simply browse through our extensive list of trusted
                        doctors,schedule your appointment hassle-free.
                    </p>
                    <div class="main-book-btn-box">
                        <?php if (isset($_SESSION['username'])): ?>
                            <button class="main-book-btn" onclick="location.href='search.php'">
                                Book appointment
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        <?php else: ?>
                            <button class="main-book-btn" onclick="location.href='login.php'">Login</button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="main-right-image">
                    <img src="img/home-img-01.png" style="width: 40rem" />
                </div>
            </div>
        </section>

        <!-- Bootstrap JS and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>