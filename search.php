<?php
session_start();
require_once('./connection.php');

class Doctor
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDoctors()
    {
        $stmt = $this->db->prepare("SELECT * FROM doctor");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchDoctors($area, $speciality)
    {
        $area = trim($area);
        $speciality = trim($speciality);

        $sql = "SELECT * FROM doctor WHERE 1";

        if (!empty($area)) {
            $sql .= " AND Division LIKE :area";
        }

        if (!empty($speciality)) {
            $sql .= " AND Speciality LIKE :speciality";
        }

        $stmt = $this->db->prepare($sql);

        if (!empty($area)) {
            $stmt->bindValue(':area', "%$area%", PDO::PARAM_STR);
        }

        if (!empty($speciality)) {
            $stmt->bindValue(':speciality', "%$speciality%", PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$doctor = new Doctor(Teledoc::connect());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area = isset($_POST['area']) ? $_POST['area'] : "";
    $speciality = isset($_POST['speciality']) ? $_POST['speciality'] : "";
    $doctors = $doctor->searchDoctors($area, $speciality);
} else {
    $doctors = $doctor->getAllDoctors();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctors</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/search.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    require 'navbar.php';

    ?>
    <div class="horizontal-line"></div>
    <section id="search-section">
        <div class="search-box">
            <form action="search.php" method="post">
                <div class="src-area">
                    <p class="form-txt">Search by Area:</p>
                    <select name="area" id="area" class="form-control">
                        <option value="" default>All</option>
                        <?php
                        // Retrieve all unique divisions regardless of search results
                        $uniqueDivisions = array_unique(array_column($doctor->getAllDoctors(), 'Division'));
                        foreach ($uniqueDivisions as $division) :
                        ?>
                            <option value="<?php echo $division; ?>" <?php if (isset($_POST['area']) && $_POST['area'] == $division) echo "selected"; ?>><?php echo $division; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="src-area">
                    <p class="form-txt">Search by Speciality:</p>
                    <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Enter speciality" value="<?php if (isset($_POST['speciality'])) echo $_POST['speciality']; ?>">
                </div>
                <div class="btn-box">
                    <button type="submit" class="src-btn">Search</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Main Content -->


    <!-- Table displaying doctors -->
    <div class="container">
        <div class="table-res">
            <table class="table" grid-gap="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Speciality</th>
                        <th>Division</th>
                        <th>Chamber Number</th>
                        <th>Hospital</th>
                        <th>Visit Charge</th>
                        <th>Time Schedule</th>
                        <th>Book now</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctors as $index => $doctor) : ?>
                        <tr>
                            <td><?php echo $doctor['Name']; ?></td>
                            <td><?php echo $doctor['Speciality']; ?></td>
                            <td><?php echo $doctor['Division']; ?></td>
                            <td><?php echo $doctor['ChamberNumber']; ?></td>
                            <td><?php echo $doctor['Hospital']; ?></td>
                            <td><?php echo $doctor['VisitCharge']; ?></td>
                            <td><?php echo $doctor['TimeStart'] . ' - ' . $doctor['TimeEnd']; ?></td>
                            <td>
                                <form action="appointment.php" method="post">
                                    <input type="hidden" name="doctorId" value="<?= htmlspecialchars($doctor['IndexNumber']) ?>">
                                    <button type="submit" class="btn-book">Book</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>