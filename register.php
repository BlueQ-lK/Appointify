<?php
session_start();
?>

<!-- TODO #3 add autologin to profile upon registration @PrashantaSarker -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            color: #fff;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.06);
            padding: 1rem 2.5rem;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
            margin: auto;
            margin-top: 2rem;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #f5f5f5;
            font-size: 2rem;
        }

        label {
            font-weight: 600;
            color: #ddd;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control,
        .btn-primary {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 0.8rem;
            border-radius: 8px;
            font-size: 1rem;
            border: none;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
        }

        .btn-primary {
            background-color: #1a6f77;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #26909d;
        }

        #passwordRequirements {
            margin-top: 0.5rem;
            font-size: 0.85rem;
        }

        #passwordRequirements ul {
            padding-left: 1.2rem;
            color: #ccc;
        }

        #passwordRequirements li {
            margin-bottom: 0.3rem;
        }

        #passwordMatch {
            font-size: 0.85rem;
            margin-top: 0.3rem;
            color: #ffd;
        }

        .error_username,
        .error_mail {
            color: #f88;
            font-size: 0.85rem;
        }

        a {
            color: #91e0ff;
        }

        p {
            text-align: center;
            margin-top: 1rem;
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
        <h2>Create Your Appointify Account</h2>
        <form action="process_register.php" method="post" id="registerForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    required
                    type="text"
                    class="form-control check_username"
                    id="username"
                    name="username" />
                <div id="UserValidity"><small class="error_username"></small></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    required
                    type="email"
                    class="form-control check_email"
                    id="email"
                    name="email" />
                <div id="emailValidity"><small class="error_mail"></small></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    required
                    type="password"
                    class="form-control"
                    id="password"
                    name="password" />
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input
                    required
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword" />
                <div id="passwordMatch"></div>
            </div>
            <div class="form-group">
                <button
                    type="submit"
                    class="btn btn-primary"
                    id="registerBtn"
                    name="signup">
                    Register
                </button>
            </div>
        </form>
        <p>Already registered? <a href="login.php">Log In Here!</a></p>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="scripts/mail.js"></script>
    <script src="scripts/register.js"></script>
</body>

</html>