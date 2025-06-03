<?php
require_once('../connection.php');
session_start();

try {
    $conn = Teledoc::connect();

    // Fetch user details
    $query = "SELECT * FROM doctor WHERE IndexNumber = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch appointment details
    $query = "SELECT d.appointment_time, d.date, d.cost, i.name 
              FROM doctor_availablity d 
              INNER JOIN info i ON i.id = d.user_id 
              WHERE d.doc_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();

    // Calculate total earning
    $totalEarning = 0;
    while ($user_details = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $totalEarning += ($user_details['cost'] * .9);
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$query = "DELETE FROM doctor_availablity WHERE app_id = :app_id;";
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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle, rgba(113, 105, 83, 1) 0%, rgba(1, 45, 51, 1) 34%);
            color: #fff;
        }

        .container {
            padding-top: 50px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .card-header {
            padding: 0.1rem;
            background: rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #fdfdfd;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            margin-bottom: 0.3rem;
            font-weight: bold;
            color: #ccc;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
        }

        .form-control:read-only {
            cursor: not-allowed;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        thead th {
            background-color: rgba(0, 60, 70, 0.6);
            padding: 0.8rem;
            color: #fff;
        }

        tbody td {
            padding: 0.8rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: #eee;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-footer {
            background: rgba(255, 255, 255, 0.06);
            text-align: center;
            padding: 1rem;
        }

        .btn-danger {
            background-color: #c0392b;
            color: white;
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #e74c3c;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex flex-column">
                            <label for="username" class="font-weight-bold">Username:</label>
                            <input type="text" readonly class="form-control" id="username" value="<?php echo $user['Name']; ?>">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="email" class="font-weight-bold">Email:</label>
                            <input type="email" readonly class="form-control" id="email" value="<?php echo $user['Email']; ?>">
                        </div>
                        <!-- Table to display appointment details -->
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Appointment Time</th>
                                        <th>Date</th>
                                        <th>Earning</th>
                                        <!-- <th>Action</th> New column for action buttons -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt->execute(); // Re-execute the query to fetch all rows again
                                    while ($user_details = $stmt->fetch(PDO::FETCH_ASSOC)):
                                    ?>
                                        <tr>
                                            <td><?php echo $user_details['name']; ?></td>
                                            <td><?php echo date('j F, Y', strtotime($user_details['appointment_time'])); ?></td>
                                            <td><?php echo date('j F, Y', strtotime($user_details['date'])); ?></td>
                                            <td><?php echo ($user_details['cost'] * .9); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <!-- Display total earning row -->
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total Earning:</strong></td>
                                        <td><?php echo $totalEarning; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="doctor_logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>