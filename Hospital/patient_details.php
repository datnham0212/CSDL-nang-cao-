<?php
session_start();

if (!isset($_SESSION["hospital_id"])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Record Homepage</title>
    <link rel="stylesheet" href="css/homepage_style.css">
    <link rel="stylesheet" href="css/patients details.css">
    <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
    <div class="sidebar-content">
        <nav>
            <ul>
                <li><a href="home.php">Patients</a></li>
                <li>
                <a href="#" id="staff-toggle">Staff</a> <!-- Staff is a subcategory -->
                <ul id="staff-submenu">
                    <li><a href="doctors.php">Doctors</a></li>
                    <li><a href="nurses.php">Nurses</a></li>
                </ul>
                </li>
                <li><a href="appointments.php">Appointments</a></li>
            </ul>
        </nav>
    </div> 
    </div>

    <div class="content" id="content">
        <button id="toggle-button" onclick="toggleSidebar()">☰</button>
        <header class="header">
    
    <!-- User Profile -->
    <div class="user-profile" id="user-profile">
    <?php
    if (isset($_SESSION["hospital_id"])) {
        echo "<p>Welcome, " . $_SESSION["hospital_id"] . "</p>";
    } 
    ?>
    <div class="profile-container">
    <img src="css/user-avatar.png" alt="User Avatar" id="profile-icon">
    <div class="profile-options" id="profile-options">
        <a href="#" onclick="changePassword()">Change Password</a>
        <a href="logout.php">Log Out</a>
    </div>
    </div>
    </div>
        </header>



<!-- Sample PHP code to demonstrate fetching demo data -->
<?php
// Assume this is a single patient with multiple records in medical history
$patientDetails = array(
    "001", 
    "John Doe", 
    "1990-05-15", 
    "Male", 
    "123 Main St, Cityville", 
    "john.doe@email.com", 
    "555-1234",
    "5'10\"",
    "160 lbs",
    "Caucasian",
    "A+",
    "Penicillin",
    "Software Engineer",
    "Jane Doe (555-5678)"
);

$medicalHistory = array(
    array("2023-01-10", "Common Cold", "Rest and fluids"),
    array("2023-02-05", "Fractured Arm", "Casting and pain medication"),
    array("2023-03-20", "Annual Checkup", "No specific treatment"),
    // Add more medical history records as needed
);
?>

<!-- Modify the HTML to include the demo data -->
<!-- Patient Details Form -->
<div class="patient-details">
    <h2>Patient Details</h2>
    <div class="form-container">
        <div class="patient-info">
            <div class="patient-mugshot">
                <img src="css/user-avatar.png" alt="Patient Mugshot">
            </div>
            <div class="details-grid">
                <div class="grid-item">
                    <label for="patientId">Patient ID:</label>
                    <span><?php echo $patientDetails[0]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="patientName">Name:</label>
                    <span><?php echo $patientDetails[1]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="dob">Date of Birth:</label>
                    <span><?php echo $patientDetails[2]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="gender">Gender:</label>
                    <span><?php echo $patientDetails[3]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="address">Address:</label>
                    <span><?php echo $patientDetails[4]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="email">Email:</label>
                    <span><?php echo $patientDetails[5]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="phone">Phone:</label>
                    <span><?php echo $patientDetails[6]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="height">Height:</label>
                    <span><?php echo $patientDetails[7]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="weight">Weight:</label>
                    <span><?php echo $patientDetails[8]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="ethnicity">Ethnicity:</label>
                    <span><?php echo $patientDetails[9]; ?></span>
                </div>
                <!-- Additional Information -->
                <div class="grid-item">
                    <label for="bloodType">Blood Type:</label>
                    <span><?php echo $patientDetails[10]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="allergies">Allergies:</label>
                    <span><?php echo $patientDetails[11]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="occupation">Occupation:</label>
                    <span><?php echo $patientDetails[12]; ?></span>
                </div>
                <div class="grid-item">
                    <label for="emergencyContact">Emergency Contact:</label>
                    <span><?php echo $patientDetails[13]; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Medical History Table -->
<div class="medical-history">
    <h2>Medical History</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Diagnosis</th>
            <th>Treatment</th>
        </tr>
        <?php
        foreach ($medicalHistory as $history) {
            echo "<tr>";
            foreach ($history as $detail) {
                echo "<td>$detail</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</div>


        <div class="button-container">
            <button class="delete-button">Delete</button>
            <button id="prevButton" onclick="navigatePatient(-1)">Previous</button>
            <button id="nextButton" onclick="navigatePatient(1)">Next</button> 
            <button class="update-button">Update Record</button>
        </div>


<footer class="footer">
            <p>&copy; <?php echo date("Y"); ?> Hospital Record Management System</p>
        </footer>
    </div>

    <script src="js/patient-details.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/user-profile.js"></script>

</body>
</html>




