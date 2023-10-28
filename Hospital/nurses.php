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
    <title>View Nurses</title>
    <link rel="stylesheet" href="homepage_style.css">
    <link rel="stylesheet" href="sidebar.css">

</head>
<body>
    <div class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
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

    <!-- User Profile -->
    <div class="user-profile">
    <img src="user-avatar.png" alt="User Avatar">
    <?php
    if (isset($_SESSION["hospital_id"])) {
        echo "<p>Welcome, " . $_SESSION["hospital_id"] . "</p>";
        /*echo "<a href='#'>Edit Profile</a>";*/
    } 
    ?>
    </div>

    </div>


    <div class="content" id="content">
        <button id="toggle-button" onclick="toggleSidebar()">☰</button>
        <header class="header">
            <h1>Hospital Record Management</h1>
        </header>

        <main class="main-section">
            <h2>Nurses List</h2>
            <div class="search-bar">
                <input type="text" id="patient-search" placeholder="Search Nurses">
                <button class="search-button" onclick="searchPatients()">Search</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>InpatientID</th>
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
                    $sql = "SELECT NurseEmployeeCode AS id, CONCAT(FirstName, ' ', LastName) AS name, InpatientID AS ipID FROM caringnurses";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["ipID"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No nurses found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>

        <footer class="footer">
            <p>&copy; <?php echo date("Y"); ?> Hospital Record Management System</p>
        </footer>
    </div>
    <script src="sidebar.js"></script>
</body>
</html>
