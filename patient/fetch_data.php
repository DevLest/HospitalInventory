<?php
require_once('../connection/dbconfig.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];

    $sql = "SELECT address, contact_number FROM pharmacycustomers WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['address' => '', 'contact_number' => '']);
    }

    $stmt->close();
}

$conn->close();
?>
