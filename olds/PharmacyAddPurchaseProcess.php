<?php
// Retrieve form data
$supplierId = $_POST['supplier']; // Assuming this is the ID of the supplier
$invoice = $_POST['invoice'];
$paymentType = $_POST['paymentType'];
$date = $_POST['date'];
$grandTotal = $_POST['grandTotal'];

// Connect to the database
$conn = new mysqli("localhost", "root", "", "data");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve supplier name based on the supplied supplier ID
$querySupplier = "SELECT name FROM pharmacy_suppliers WHERE id = ?";
$stmtSupplier = $conn->prepare($querySupplier);
$stmtSupplier->bind_param("i", $supplierId);
$stmtSupplier->execute();
$stmtSupplier->bind_result($supplierName);
$stmtSupplier->fetch();
$stmtSupplier->close();

// Map the payment type to the corresponding payment status
$paymentStatus = '';
switch ($paymentType) {
    case 'Cash Payment':
        $paymentStatus = 'PAID';
        break;
    case 'Net Banking':
        $paymentStatus = 'PAID ON BANK';
        break;
    case 'Payment Due':
        $paymentStatus = 'PENDING';
        break;
}

// Prepare and execute the query to insert purchase details with payment status
$query = "INSERT INTO pharmacy_purchase_details (supplier, invoice, payment_type, date, grand_total, payment_status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssds", $supplierName, $invoice, $paymentType, $date, $grandTotal, $paymentStatus);
$stmt->execute();

// Get the ID of the last inserted purchase
$purchaseId = $conn->insert_id;

// Loop through the medicine details and insert each row into the database
for ($i = 0; $i < count($_POST['medicineName']); $i++) {
    $medicineName = $_POST['medicineName'][$i];
    $packing = $_POST['packing'][$i];
    $expiryDate = $_POST['expiryDate'][$i];
    $quantity = $_POST['quantity'][$i];
    $price = $_POST['price'][$i];
    $amount = $quantity * $price;

    // Insert medicine details with the same supplier as the purchase
    $stmtMedicine = $conn->prepare("INSERT INTO pharmacy_medicine_details (purchase_id, supplier, medicine_name, packing, expiry_date, quantity, price, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtMedicine->bind_param("isssisddd", $purchaseId, $supplierName, $medicineName, $packing, $expiryDate, $quantity, $price, $amount);
    $stmtMedicine->execute();
}

// Update the supplier field in the pharmacy_medicine_details table
$queryUpdateSupplier = "UPDATE pharmacy_medicine_details SET supplier = ? WHERE purchase_id = ?";
$stmtUpdateSupplier = $conn->prepare($queryUpdateSupplier);
$stmtUpdateSupplier->bind_param("si", $supplierName, $purchaseId);
$stmtUpdateSupplier->execute();
$stmtUpdateSupplier->close();

// Close the statement
$stmtMedicine->close();

// Close the database connection
$stmt->close();
$conn->close();

// Redirect to a success page or back to the form
header("Location: PharmacyAddPurchase.php");
exit();
?>
