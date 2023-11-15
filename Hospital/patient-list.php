<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients List</title>
    <link rel="stylesheet" href="css/homepage_style.css">
    <link rel="stylesheet" href="css/sidebar.css">

    <!-- Add any additional stylesheets or scripts here -->

</head>
<body>
    <!-- Add your sidebar and content divs here -->

    <main class="main-section">
        <?php
        // Check if the doctor_id is set in the URL
        if (isset($_GET['doctor_id'])) {
            $doctorId = $_GET['doctor_id'];

            // Now you can fetch and display the list of patients associated with the specified doctor
            // Modify the SQL query as per your database schema
            // Example: $sql = "SELECT * FROM patients WHERE doctor_id = $doctorId";

            // Display the heading
            echo "<h2>List of Patients that Doctor in Charge of</h2>";

            // Display a demo table (replace this with your actual patient data)
            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Age</th>";
            // Add more columns as needed
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            // Example data (replace this with actual data fetching from the database)
            for ($i = 1; $i <= 5; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>Patient $i</td>";
                echo "<td>25</td>";
                // Add more cells as needed
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // Handle the case where doctor_id is not set
            echo "<p>Error: Doctor ID not provided.</p>";
        }
        ?>
    </main>

    <!-- Add your footer and scripts here -->

</body>
</html>
