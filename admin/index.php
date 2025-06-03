<?php
session_start();
require('../connection.php');

if (isset($_POST['login'])) {
    $_SESSION['validate'] = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $p = teledoc::connect()->prepare('SELECT * FROM info WHERE name=:u AND user_type=0');
    $p->bindValue(':u', $username);
    $p->execute();
    $user = $p->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $storedPassword = $user['pass'];

        if ($password === $storedPassword) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['validate'] = true;
            header('location:profile.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle, rgba(113, 105, 83, 1) 0%, rgba(1, 45, 51, 1) 34%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            background: rgba(255, 255, 255, 0.06);
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.6rem;
            color: #fdfdfd;
        }

        .card-body {
            padding: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #ddd;
        }

        .form-control {
            width: 100%;
            box-sizing: border-box;
            padding: 0.75rem;
            border-radius: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            margin-bottom: 1.2rem;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
        }

        .btn-primary {
            background-color: #1a6f77;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
            box-sizing: border-box;
        }

        .btn-primary:hover {
            background-color: #2495a2;
        }

        p {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.95rem;
            color: #ccc;
        }

        a {
            color: #91e0ff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Admin Login</h3>
            </div>
            <div class="card-body">
                <!-- Your PHP code for the form goes here -->

                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" value="login_button" name="login">Login</button>
                </form>
                <p class="text-center mt-3"></p>
            </div>
        </div>
    </div>
</body>

</html>