<?php
require_once('./connection.php');

session_start();

$doctorId = $_POST['doctorId'];

try {
    $conn = Teledoc::connect();
    $query = "SELECT * FROM doctor WHERE IndexNumber = :doctorId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':doctorId', $doctorId);
    $stmt->execute();
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment with <?php echo $doctor['Name']; ?></title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/appointment.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #appointmentTime {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    require 'navbar.php';
    ?>
    <!-- Main Content -->
    <div class="horizontal-line"></div>
    <div class="container">
        <!-- Doctor Profile -->
        <div class="profile-card">
            <center>
                <img src="img/doc1.jpg" alt="Doctor" class="profile-img" />
                <div class="doc-name"><?php echo $doctor['Name']; ?></div>
                <div class="badge"><?php echo $doctor['Speciality']; ?></div>
            </center>
            <ul class="info-list">
                <li>
                    <strong>Email:</strong>
                    <?php echo $doctor['Email']; ?>
                </li>
                <li>
                    <strong>Degree:</strong>
                    <?php echo $doctor['Degree']; ?>
                </li>
                <li>
                    <strong>Division:</strong>
                    <?php echo $doctor['Division']; ?>
                </li>
                <li>
                    <strong>Hospital:</strong>
                    <?php echo $doctor['Hospital']; ?>
                </li>
                <li>
                    <strong>Chamber Contact No:</strong>
                    <?php echo $doctor['ChamberNumber']; ?>
                </li>
                <li>
                    <strong>Chamber Location:</strong>
                    <?php echo $doctor['ChamberLocation']; ?>
                </li>
                <li>
                    <strong>Charge:</strong>
                    <?php echo $doctor['VisitCharge']; ?>
                </li>
                <li>
                    <strong>Timing:</strong>
                    <?php echo $doctor['TimeStart'] . ' to ' . $doctor['TimeEnd']; ?>
                </li>
            </ul>
        </div>

        <!-- Appointment Form -->
        <div class="appointment-panel">
            <h2>Book Your Appointment</h2>
            <form action="book_appointment.php" method="post">
                <input
                    type="hidden"
                    name="doctorId"
                    value="<?php echo $doctorId; ?>" />

                <div class="form-group">
                    <label for="appointmentDate">Select Date</label>
                    <input type="date" name="appointmentDate" id="appointmentDate"
                        value="<?php echo date("Y-m-d") ?>" min="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label for="appointmentTime">Select Time</label>
                    <select name="appointmentTime" id="appointmentTime" required>
                        <?php
                        try {
                            $excludeQuery = "SELECT d.appointment_time FROM doctor e INNER JOIN doctor_availablity d ON e.IndexNumber = d.doc_id WHERE e.IndexNumber = :doctorId";
                            $excludeStmt = $conn->prepare($excludeQuery);
                            $excludeStmt->bindParam(':doctorId', $doctorId);
                            $excludeStmt->execute();
                            $excludeTimes = [];
                            while ($row =
                                $excludeStmt->fetch(PDO::FETCH_ASSOC)
                            ) {
                                $excludeTimes[] =
                                    $row['appointment_time'];
                            }
                            $startTimeObj = new
                                DateTime($doctor['TimeStart']);
                            $endTimeObj = new
                                DateTime($doctor['TimeEnd']);
                            $interval = new
                                DateInterval('PT1H');
                            $appointmentTime = clone $startTimeObj;
                            while ($appointmentTime < $endTimeObj) {
                                $appointmentTimeString =
                                    $appointmentTime->format('H:i:s');
                                if (!in_array($appointmentTimeString, $excludeTimes)) {
                                    echo '
              <option value="' . $appointmentTimeString . '">
                ' . $appointmentTimeString . '
              </option>
              ';
                                }
                                $appointmentTime->add($interval);
                            }
                        } catch (PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="charge">Charge</label>
                    <input
                        type="text"
                        name="charge"
                        id="charge"
                        value="<?php echo $doctor['VisitCharge']; ?>"
                        readonly />
                </div>
                <div class="tacbox">
                    <input id="checkbox" type="checkbox" required />
                    <span> I agree to these <a href="#">Terms and Conditions</a>.</span>
                </div>
                <button type="submit" class="btn">Confirm Appointment</button>
            </form>
        </div>
    </div>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>