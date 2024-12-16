<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Adjust your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process refund request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pos_number = $_POST['pos_number'];
    $refund_amount = $_POST['refund_amount'];
    $reason = $_POST['reason'];

    // Check if the receipt exists
    $check_receipt = "SELECT * FROM receipts WHERE pos_number = '$pos_number'";
    $result = $conn->query($check_receipt);

    if ($result->num_rows > 0) {
        // Update receipt record to mark refund
        $sql = "UPDATE receipts 
                SET refunded_amount = '$refund_amount', 
                    refund_reason = '$reason', 
                    refunded_at = NOW() 
                WHERE pos_number = '$pos_number'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Refund processed successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: POS number not found!";
    }
}

$conn->close();
?>
