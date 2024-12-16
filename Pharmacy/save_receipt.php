<?php
// Start session
session_name('PharmacyCashierSession'); // Use the same session name as when the user logged in
session_start(); // Start session

require_once('../connection/dbconfig.php'); 



// Check if user is logged in and retrieve user_id
if (!isset($_SESSION['user_id'])) { // Ensure user_id is stored in the session
    die("User is not logged in.");
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

$posNumber = $data['pos_number'];
$total = $data['total'];
$paidAmount = $data['paid_amount'];
$changeAmount = $data['change_amount'];
$discountAmount = isset($data['discount']) ? $data['discount'] : 0.00; // Default to 0 if not set
$items = $data['items'];

// Get the user_id from the session
$userId = $_SESSION['user_id'];

// Insert into receipts table
$sql = "INSERT INTO receipts (pos_number, total, paid_amount, change_amount, discount_amount, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddds", $posNumber, $total, $paidAmount, $changeAmount, $discountAmount, $userId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $receiptId = $stmt->insert_id; // Get the last inserted ID
    $stmt->close();

    // Insert items into receipt_items table
    $sql = "INSERT INTO receipt_items (receipt_id, medicine_product, quantity, price, total) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isddd", $receiptId, $medicineProduct, $quantity, $price, $total);

    foreach ($items as $item) {
        $medicineProduct = $item['medicine_product'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $total = $item['total'];
        $stmt->execute();
    }

    $stmt->close();
    echo json_encode(['status' => 'success', 'receiptId' => $receiptId]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save receipt']);
}

// Close the connection
$conn->close();
?>
