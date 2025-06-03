<?php
require_once('./connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("You are not logged in. Please login first.");</script>';
    header('Location: login.php');
    exit();
} else {
    // Echoing the information passed from the previous page
    // echo $_SESSION['user_id'];
    // echo $_POST['doctorId'];
    // echo $_POST['appointmentDate'];
    // echo $_POST['charge'];
    $user_id = $_SESSION['user_id'];
    $doctor = $_POST['doctorId'];
    $charge = $_POST['charge'];
    $appointment_date = $_POST['appointmentDate'];
    $appointment_time = $_POST['appointmentTime'];
    $formatted_appointment_date = date('j F, Y', strtotime($appointment_date));
    $formatted_appointment_time = date('h:i A', strtotime($appointment_time));


    try {
        // Connect to the database
        $conn = Teledoc::connect();

        // Prepare the query to select the username associated with the user ID
        $usernameQuery = "select name from info where user_type = 2 and id=:user_id";

        // Prepare and execute the statement
        $usernameStmt = $conn->prepare($usernameQuery);
        $usernameStmt->bindParam(':user_id', $user_id);
        $usernameStmt->execute();

        // Fetch the username
        $row = $usernameStmt->fetch(PDO::FETCH_ASSOC);
        $username = $row['name'];
    } catch (PDOException $e) {
        // Handle any errors
        echo 'Error: ' . $e->getMessage();
    }
    try {
        // Connect to the database
        $conn = Teledoc::connect();

        $doctorQuery = "select d.name from doctor d where IndexNumber=:doctor";
        $doctorStmt = $conn->prepare($doctorQuery);
        $doctorStmt->bindParam(':doctor', $doctor);
        $doctorStmt->execute();
        $row = $doctorStmt->fetch(PDO::FETCH_ASSOC);

        $doctor_name = $row['name'];

        // Now you have $username containing the username associated with the doctor
        // Proceed with your logic here...

    } catch (PDOException $e) {
        // Handle any errors
        echo 'Error: ' . $e->getMessage();
    }
}

// Calculating the payment amount based on the charge (you can adjust this logic as needed)

?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <style>
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: radial-gradient(circle,
                    rgba(113, 105, 83, 1) 0%,
                    rgba(1, 45, 51, 1) 34%);
            color: #e8e6d2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 2rem;
        }

        .payment-form {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .payment-form h1 {
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            color: #f1f1e6;
        }

        .details {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .details li {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #d4cdb5;
        }

        .text-center {
            text-align: center;
        }

        .submit-btn {
            background-color: #6b9a97;
            color: #f1f1e6;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #8fb3b1;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="payment-form">
            <h1>Make Payment</h1>

            <form method="POST" action="payment_success.php">
                <ul class="details">
                    <li><strong>User Name:</strong> <?php echo $username; ?></li>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="doc_id" value="<?php echo $doctor; ?>" hidden>
                    <input type="text" name="appointment_time" value="<?php echo $appointment_time; ?>" hidden>
                    <input type="text" name="appointment_date" value="<?php echo $appointment_date; ?>" hidden>
                    <input type="text" name="cost" value="<?php echo $charge; ?>" hidden>
                    <li><strong>Doctor Name:</strong> <?php echo $doctor_name; ?></li>
                    <li><strong>Appointment Date:</strong> <?php echo $formatted_appointment_date; ?></li>
                    <li><strong>Appointment Time:</strong> <?php echo $formatted_appointment_time; ?></li>
                    <li><strong>Charge:</strong> <?php echo $charge; ?> tk</li>
                </ul>

                <input type="hidden" name="amount" value="<?php echo $charge; ?>">

                <div class="text-center">
                    <button type="submit" class="submit-btn">Make Payment</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>