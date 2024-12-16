<?php
// Database connection
$servername = "localhost";  // Your database server name
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch receipt data
$sql = "SELECT id, pos_number, total, created_at, paid_amount, change_amount, discount_amount FROM receipts";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output each row as a table row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['pos_number'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>" . $row['paid_amount'] . "</td>";
        echo "<td>" . $row['change_amount'] . "</td>";
        echo "<td>" . $row['discount_amount'] . "</td>";
        echo "</tr>";
    }
} else {
    // If no receipts are found
    echo "<tr><td colspan='7'>No receipts found</td></tr>";
}

// Close connection
$conn->close();
?>