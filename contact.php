<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            color: #fff;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;

            background-color: #0a2b2f;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .contact-section {
            flex: 1;
            padding: 40px 7rem;
        }

        .logo-text {
            font-size: 28px;
            font-weight: bold;
            color: #c9a95a;
            margin-bottom: 20px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            font-size: 24px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #ddd;
        }

        input,
        textarea {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            font-size: 16px;
            background: #fff;
            color: #333;
            border-radius: 5px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #888;
        }

        input:focus,
        textarea:focus {
            border-color: #c9a95a;
            outline: none;
        }

        button {
            padding: 14px;
            background-color: #c9a95a;
            color: #1e1e1e;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b2904d;
        }

        .contact-info {
            margin-top: 30px;
            font-size: 14px;
            color: #ccc;
            text-align: center;
        }

        .social-icons {
            margin-top: 25px;
            text-align: center;
        }

        .social-icons a {
            color: #c9a95a;
            margin: 0 10px;
            font-size: 24px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ffffff;
        }

        .image-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #143f44;
        }

        .image-section img {
            width: 100%;

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
    <div class="container">
        <div class="contact-section">
            <h2>Contact Us</h2>
            <form action="#" method="POST">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Your name"
                    required />

                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="your@example.com"
                    required />

                <label for="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                    placeholder="How can we help you?"
                    required></textarea>

                <button type="submit">Send Message</button>
            </form>
            <div class="contact-info">
                <p>Email: contact@appointify.com</p>
                <p>Phone: +1 (234) 567-8900</p>
                <p>Location: 123 DK , Mangalore city, MG road</p>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f" title="Facebook"></i></a>
                <a href="#"><i class="fab fa-twitter" title="Twitter"></i></a>
                <a href="#"><i class="fab fa-instagram" title="Instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in" title="LinkedIn"></i></a>
            </div>
        </div>
        <div class="image-section">
            <img
                src="img/conactus.jpg"
                alt="Doctor or Clinic" />
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>