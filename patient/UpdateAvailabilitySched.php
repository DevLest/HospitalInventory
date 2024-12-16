<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$date = $_POST['date'];
$availability = $_POST['availability'];
$availableTime = $_POST['available_time'];
$doctorId = $_POST['doctor_id'];

// Check if an availability record exists for this date
$sql = "SELECT * FROM calendar_availability WHERE date = '$date' AND doctor_id = '$doctorId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Update existing record
    $sql = "UPDATE calendar_availability SET availability='$availability', available_time='$availableTime' WHERE date='$date' AND doctor_id='$doctorId'";
} else {
    // Insert new record
    $sql = "INSERT INTO calendar_availability (date, availability, available_time, doctor_id) VALUES ('$date', '$availability', '$availableTime', '$doctorId')";
}

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
