<?php
// Database configuration
$servername = "localhost"; // Assuming your MySQL server is running locally
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password
$database = "data"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch supplier names
$sql = "SELECT name FROM pharmacy_suppliers";
$result = $conn->query($sql);

$suppliers = array();

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch data and store in array
    while ($row = $result->fetch_assoc()) {
        $supplier = array(
            'name' => $row['name']
        );
        $suppliers[] = $supplier;
    }
}

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($suppliers);
?>