<?php
// Define your database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitaldb";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for error handling
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_id = $_POST["hospital_id"];
    $password = $_POST["password"];

    // Validate credentials and perform login logic here
    $sql = "SELECT * FROM users WHERE hospital_id = '$hospital_id'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, now verify the password
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"]; // Replace "password" with the actual column name in your users table where passwords are stored.

        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session and set user_id
            session_start();
            
            $_SESSION["user_id"] = $row["user_id"]; // Replace "user_id" with the actual column name that represents the user's unique identifier.
            
            $_SESSION["hospital_id"] = $hospital_id; // Store the hospital_id in the session.
            
            // Redirect to the homepage on successful login
            header("Location: home.php");
            exit;
        } else {
            $login_error = "Invalid password";
        }
    } else {
        $login_error = "Hospital ID not found";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Record Management</title>
    <link rel="stylesheet" href="css/signIn.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="hospital_id">Hospital ID:</label>
                <input type="text" id="hospital_id" name="hospital_id" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p style="color: red;"><?php echo $login_error; ?></p>
        </form>
    </div>
</body>
</html>