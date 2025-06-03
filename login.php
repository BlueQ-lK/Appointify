<?php
session_start();
require('connection.php');

if (isset($_POST['login'])) {
    $_SESSION['validate'] = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $p = teledoc::connect()->prepare('SELECT * FROM info WHERE name=:u AND user_type=2');
    $p->bindValue(':u', $username);
    $p->execute();
    $user = $p->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $storedPassword = $user['pass'];

        if ($password === $storedPassword) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['validate'] = true;
            echo '<script>alert("You have been logged in!");</script>';
            header('Location: index.php');
            exit;
        } else {
            $error_message = "Password mismatch!";
        }
    } else {
        $error_message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            font-family: 'poppins', sans-serif;
            background: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            height: 100vh;
            color: #e8e6d2;
            padding: 0;
            overflow: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.08);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
            text-align: center;
            position: relative;
            z-index: 1;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            margin: auto;
        }

        h1 {
            color: #f5f5e8;
            font-size: 2.4rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .alert {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }

        .form-label {
            font-weight: 600;
            color: #d4cdb5;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f1e6;
            padding: 0.8rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .btn {
            background-color: #1a4f57;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #227b88;
        }

        p {
            color: #d4cdb5;
            font-size: 1rem;
            margin-top: 1.5rem;
        }

        a {
            color: #6cb2eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .background-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.05);
            user-select: none;
            pointer-events: none;
            z-index: 0;
        }

        input.form-control,
        button.btn {
            display: block;
            width: 100%;
            box-sizing: border-box;
            /* Ensures padding doesn't break width */
            margin-bottom: 1.5rem;
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
    require "navbar.php";
    ?>
    <!-- Main Content -->
    <div class="horizontal-line"></div>
    <div class="container mt-5 main-content">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Login to Appointify</h1>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" value="login_button" name="login">Login</button>
                </form>
                <p class="mt-3">Don't have an account? <a href="register.php">Register Here!</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>