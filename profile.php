<?php
require_once('./connection.php');
session_start();

try {
    $conn = Teledoc::connect();

    // Fetch user details
    $query = "SELECT * FROM info WHERE user_type = 2 AND id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch appointment details
    $query = "SELECT d.name, da.appointment_time, da.date, da.cost, da.app_id FROM doctor d INNER JOIN doctor_availablity da ON da.doc_id = d.IndexNumber WHERE da.user_id = :user_id";
    $ccstmt = $conn->prepare($query);
    $ccstmt->bindParam(':user_id', $_SESSION['user_id']);
    $ccstmt->execute();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$query = "DELETE from doctor_availablity where app_id = :app_id;";
$appstmt = $conn->prepare($query);
$appstmt->bindParam(':app_id', $_POST['app_id']);
$appstmt->execute();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            color: #e8e6d2;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-x: hidden;
        }

        .container {
            max-width: 950px;
            width: 100%;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .card-header {
            padding: 2rem;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-header h3 {
            margin: 0;
            font-size: 2rem;
            color: #f5f5e8;
        }

        .card-header p {
            margin-top: 0.5rem;
            font-size: 1rem;
            color: #c8c6b8;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #d4cdb5;
        }

        input.form-control {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.08);
            color: black;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 0.6rem;
        }

        .table-responsive {
            margin-top: 2.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.02);
        }

        th,
        td {
            padding: 0.85rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            text-align: left;
            color: #f1f1e6;
            font-size: 0.95rem;
        }

        thead {
            background-color: rgba(255, 255, 255, 0.08);
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-danger {
            background-color: #b23b3b;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #d9534f;
        }

        .btn-sm {
            padding: 0.3rem 0.75rem;
            font-size: 0.8rem;
        }

        .card-footer {
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(255, 255, 255, 0.03);
        }

        .background-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -70%) rotate(-20deg);
            font-size: 20rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.041);
            white-space: nowrap;
            user-select: none;
            pointer-events: none;
            z-index: 0;
        }

        .action-buttons {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons a {
            padding: 0.4rem 0.9rem;
            color: #fff;
            text-decoration: none;
            font-size: 0.85rem;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        .action-buttons a:hover {
            background-color: #227b88;
        }

        .action-buttons a:nth-child(1) {
            background-color: #4CAF50;
            /* Green */
        }

        /* Search Button */
        .action-buttons a:nth-child(2) {
            background-color: #2196F3;
            /* Blue */
        }
    </style>
</head>

<body>
    <div class="background-text">Appointify</div>
    <div class="container">
        <div class="card">
            <div class="action-buttons">
                <a href="index.php">Home</a>
                <a href="search.php">Search</a>
            </div>
            <div class="card-header">
                <h3>User Profile</h3>
                <p>
                    Welcome back, <strong><?php echo $user['name']; ?></strong>. Here’s
                    your account and appointment history.
                </p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input
                        type="text"
                        readonly
                        class="form-control"
                        id="username"
                        value="<?php echo $user['name']; ?>" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input
                        type="email"
                        readonly
                        class="form-control"
                        id="email"
                        value="<?php echo $user['email']; ?>" />
                </div>

            </div>

            <!-- Table of appointments -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Appointment Time</th>
                            <th>Date</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user_details = $ccstmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                            <tr>
                                <td><?php echo $user_details['name']; ?></td>
                                <td>
                                    <?php echo date('g:i A', strtotime($user_details['appointment_time'])); ?>
                                </td>
                                <td>
                                    <?php echo date('j F, Y', strtotime($user_details['date'])); ?>
                                </td>
                                <td><?php echo $user_details['cost']; ?></td>
                                <td>
                                    <form method="post" action="profile.php">
                                        <input
                                            type="hidden"
                                            name="app_id"
                                            value="<?php echo $user_details['app_id']; ?>" />
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    </div>


</body>

</html>