<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "data");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['medicine_id'])) {
    $medicine_id = $_POST['medicine_id'];

    // Fetch medicine details from the database
    $query = "SELECT packing, batch_id, expiry_date, price FROM pharmacy_medicine_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $medicine_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}

$conn->close();
?>
