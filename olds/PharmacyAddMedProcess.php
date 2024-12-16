<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['customerName'];
    $packing = $_POST['contactNumber'];
    $generic_name = $_POST['address'];
    $supplier = $_POST['doctorName'];

    $sql = "INSERT INTO pharmacy_medicines (medicine_name, packing, generic_name, supplier)
            VALUES ('$medicine_name', '$packing', '$generic_name', '$supplier')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    // Redirect back to the form page
    header("Location: PharmacyAddMed.php");
    exit();
}
?>
