<?php
// Replace with actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the last POS number from the receipts table
$sql = "SELECT pos_number FROM receipts ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastPosNumber = $row['pos_number'];
    $lastNumber = intval(substr($lastPosNumber, 4)); // Extract the number part
    $nextNumber = $lastNumber + 1;
    $nextPosNumber = 'POS-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
} else {
    // If no receipts yet, start with POS-001
    $nextPosNumber = 'POS-001';
}

echo $nextPosNumber;

$conn->close();
?>