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
    <title>View Doctors</title>
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
            <h2>Doctors List</h2>
            <div class="search-bar">
                <input type="text" id="patient-search" placeholder="Search Doctors">
                <button class="search-button" onclick="searchPatients()">Search</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialty</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Fetch and display doctors' records
                    $sql = "SELECT EmployeeCode AS id, CONCAT(FirstName, ' ', LastName) AS name, SpecialityName AS specialty FROM doctors";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='doctor-row' data-doctor-id='" . $row["id"] . "'>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["specialty"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No doctors found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
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
    <script src="js/patient-list.js"></script>
</body>
</html>
