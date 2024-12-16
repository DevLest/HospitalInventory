<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicineId = $_POST['medicine_id'];
    $newPacking = $_POST['new_packing'];

    // Update the packing quantity in the database
    $sql = "UPDATE pharmacy_medicine_details SET packing = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newPacking, $medicineId);

    if ($stmt->execute()) {
        echo "Packing updated successfully.";
    } else {
        echo "Error updating packing: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
