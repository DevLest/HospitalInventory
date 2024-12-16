<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establishing connection to the database
    $conn = new mysqli("localhost", "root", "", "data");

    // Checking for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO pharmacy_invoice (customer_id, invoice_number, payment_type, date, total_amount, total_discount, net_total, paid_amount, change_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    // Assigning values to variables
    // Example: You need to replace these with your form data
    $customer_id = $_POST['customer_id']; // Assuming you have a customer_name field in your form
    $invoice_number = $_POST['invoice_number'];
    $payment_type = $_POST['payment_type'];
    $date = $_POST['date'];
    $total_amount = $_POST['total_amount'];
    $total_discount = $_POST['total_discount'];
    $net_total = $_POST['net_total'];
    $paid_amount = $_POST['paid_amount'];
    $change_amount = $_POST['change_amount'];

    // Binding parameters to the prepared statement
    $stmt->bind_param('ssssddddd', $customer_id, $invoice_number, $payment_type, $date, $total_amount, $total_discount, $net_total, $paid_amount, $change_amount);

    // Executing the prepared statement
    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Closing the statement and connection
    $stmt->close();
    $conn->close();
}
?>
