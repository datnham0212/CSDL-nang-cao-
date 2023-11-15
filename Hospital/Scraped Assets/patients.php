<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="homepage_style.css">
    <link rel="stylesheet" href="sidebar.css">
    <!-- Add this CSS code inside your <style> section -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="patients.php">Patients</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li><a href="nurses.php">Nurses</a></li>
                <li><a href="appointments.php">Appointments</a></li>
            </ul>
        </nav>
    </div>

    <div class="content" id="content">
        <button id="toggle-button" onclick="toggleSidebar()">☰</button>
        <header class="header">
            <h1>Hospital Record Management</h1>
        </header>

        <main class="main-section">
            <div class="search-bar">
                <input type="text" id="patient-search" placeholder="Search Patients">
                <button class="search-button" onclick="searchPatients()">Search</button>
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

                    // Fetch and display patient records
                    $sql = "SELECT PatientCode, CONCAT(FirstName, ' ', LastName) AS FullName, DateOfBirth, Gender, Address, PhoneNumber FROM patients";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
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
        </main>

        <footer class="footer">
            <p>&copy; <?php echo date("Y"); ?> Hospital Record Management System</p>
        </footer>
    </div>
        <script src="sidebar.js"></script>
</body>
</html>
