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

        <main class="main-section">
    <h2>Manage Patients</h2>
    <div class="add-search-container">
            <div class="add-button-container">
                <button id="add-patient-button" onclick="openAddWindow()">+</button>
            </div>
            <div class="search-bar">
                <input type="text" id="patient-search" placeholder="Search Patients" oninput="searchPatients()">
                <button class="search-button" onclick="searchPatients()">Search</button>
            </div>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Full Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        
                        <!-- Add more columns as needed -->
                    
                   </tr>
                </thead>
                <tbody id="patient-list">
                    <?php
                    // Connect to your database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "hospitaldb";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch and display patient records
                    $sql = "SELECT PatientCode, CONCAT(FirstName, ' ', LastName) AS FullName, DateOfBirth, Gender, Address, PhoneNumber FROM patients";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='patient-row' data-patient-id='" . $row["PatientCode"] . "'>";
                            echo "<td>" . $row["PatientCode"] . "</td>";
                            echo "<td>" . $row["FullName"] . "</td>";
                            echo "<td>" . $row["DateOfBirth"] . "</td>";
                            echo "<td>" . $row["Gender"] . "</td>";
                            echo "<td>" . $row["Address"] . "</td>";
                            echo "<td>" . $row["PhoneNumber"] . "</td>";                            
                            // Add more columns as needed
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No patients found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>


<div class="add-window" id="add-window">
    <div class="add-content">
        <label for="patient-name">Patient Name:</label>
        <input type="text" id="patient-name" required>
        
        <label for="gender">Gender:</label>
        <select id="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" required>

        <label for="phone-number">Phone Number:</label>
        <input type="tel" id="phone-number" pattern="[0-9]{10}" required>

        <label for="address">Address:</label>
        <input type="text" id="address" required>

        <button onclick="closeAddWindow()">Close</button>
    </div>
</div>

        </main>

<div class="button-container">
            
            <button id="prevButton" onclick="navigatePatient(-1)">Previous</button>
            <button id="nextButton" onclick="navigatePatient(1)">Next</button> 
            
        </div>

        <footer class="footer">
            <p>&copy; <?php echo date("Y"); ?> Hospital Record Management System</p>
        </footer>
    </div>

    <script src="js/patient-details.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/search-patients.js"></script>
    <script src="js/user-profile.js"></script>


<script>

function openAddWindow() {
    var addWindow = document.getElementById('add-window');
    addWindow.style.display = 'block';
}

function closeAddWindow() {
    var addWindow = document.getElementById('add-window');
    addWindow.style.display = 'none';
}

</script>


</body>
</html>
