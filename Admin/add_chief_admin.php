<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "database"; // Replace with your database name

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $chief_license = $_POST['chief_license'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $address = $_POST['address'] ?? '';

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data
    $sql = "INSERT INTO chief_admins (username, password, email, role, chief_license, contact_number, address, created_at)
            VALUES (?, ?, ?, 'Chief Admin', ?, ?, ?, NOW())";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $hashedPassword, $email, $chief_license, $contact_number, $address);

    // Execute query
    if ($stmt->execute()) {
        echo "<div class='alert alert-success mt-4'>Chief Admin added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Error: " . $conn->error . "</div>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
