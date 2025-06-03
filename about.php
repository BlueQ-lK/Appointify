<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        :root {
            --main-bg: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            --text-color: #f0e6d2;
            --accent-color: #ffc96b;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--main-bg);
            color: var(--text-color);
        }

        header {
            text-align: center;
            padding: 60px 20px 30px;
        }

        header h1 {
            font-size: 3.2rem;
            margin-bottom: 10px;
            color: #fff;
        }

        header p {
            font-size: 1.2rem;
            color: var(--accent-color);
            font-weight: 500;
        }

        .about-container {
            max-width: 1000px;
            margin: auto;
            padding: 40px 20px;
        }

        .about-section {
            margin-bottom: 50px;
        }

        .about-section h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--accent-color);
        }

        .about-section p {
            font-size: 1.05rem;
            line-height: 1.8;
            margin: 0;
        }

        footer {
            text-align: center;
            padding: 25px 10px;
            font-size: 0.9rem;
            color: #cfcfcf;
        }

        .horizontal-line {
            height: 1px;
            width: 96%;
            margin: 0 auto;
            background: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    require 'navbar.php';
    ?>
    <div class="horizontal-line"></div>
    <header>
        <h1>Welcome to Appointify</h1>
        <p>Where Healthcare Meets Simplicity</p>
    </header>

    <div class="about-container">
        <section class="about-section">
            <h2>Our Mission</h2>
            <p>
                Appointify is here to revolutionize how you book medical appointments.
                Our goal is simple — eliminate waiting times, simplify scheduling, and
                give you direct access to trusted healthcare professionals at your
                fingertips.
            </p>
        </section>

        <section class="about-section">
            <h2>Why Appointify?</h2>
            <p>
                We offer a seamless platform where patients can view doctor profiles,
                availability, and consultation charges — all in one place. Whether
                it's a routine visit or a specialist consultation, you're just a click
                away from getting the care you need.
            </p>
        </section>

        <section class="about-section">
            <h2>Our Commitment</h2>
            <p>
                We’re not just a platform — we’re a promise to make healthcare more
                accessible and less stressful. With user-friendly tools and 24/7
                access, Appointify ensures you're always in control of your
                appointments.
            </p>
        </section>

        <section class="about-section">
            <h2>Join Us</h2>
            <p>
                Discover the smarter way to manage your healthcare. Book appointments
                anytime, from anywhere — with <strong>Appointify</strong>.
            </p>
        </section>
    </div>

    <footer>&copy; 2025 Appointify. All rights reserved.</footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>