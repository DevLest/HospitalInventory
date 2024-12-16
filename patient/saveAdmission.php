<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admission_id = $_POST['admission_id'];
    $patient_id = $_POST['patient_id'];
    $status = $_POST['status'];
    // ... other form data

    // Database connection credentials
    $servername = "localhost";
    $username = "root"; // Replace with your actual database username
    $password = ""; // Replace with your actual database password
    $dbname = "data"; // Replace with your actual database name

    // Create a connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "UPDATE admissionpatient SET status = ? WHERE admission_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $status, $admission_id);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
