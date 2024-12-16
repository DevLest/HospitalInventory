<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

// Check if data is valid
if (is_array($data) && !empty($data)) {
    foreach ($data as $item) {
        // Validate item structure
        if (isset($item['medicine_product']) && isset($item['quantity'])) {
            $productName = $conn->real_escape_string($item['medicine_product']);
            $quantity = intval($item['quantity']);

            // Update quantities in pharmacy_medicines_products
            $sql_medicines = "UPDATE pharmacy_medicines_products
                              SET sold_quantity = sold_quantity + ?,
                                  registered_quantity = registered_quantity - ?
                              WHERE medicine_product = ?";

            if ($stmt = $conn->prepare($sql_medicines)) {
                $stmt->bind_param("iis", $quantity, $quantity, $productName);
                if ($stmt->execute()) {
                    echo "Record updated successfully in pharmacy_medicines_products for product $productName";
                } else {
                    echo "Error updating record in pharmacy_medicines_products for product $productName: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement for pharmacy_medicines_products: " . $conn->error;
            }

            // Update quantities in pharmacy_products
            // Convert registered_quantity to an integer for arithmetic operations
            $sql_products = "UPDATE pharmacy_products
                             SET registered_quantity = CAST(registered_quantity AS UNSIGNED) - ?,
                                 sold_quantity = sold_quantity + ?
                             WHERE product = ?";

            if ($stmt = $conn->prepare($sql_products)) {
                $stmt->bind_param("iis", $quantity, $quantity, $productName);
                if ($stmt->execute()) {
                    echo "Record updated successfully in pharmacy_products for product $productName";
                } else {
                    echo "Error updating record in pharmacy_products for product $productName: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement for pharmacy_products: " . $conn->error;
            }
        } else {
            echo "Invalid data structure.";
        }
    }
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'No data received or data is invalid.'
    ]);
}

$conn->close();
?>
