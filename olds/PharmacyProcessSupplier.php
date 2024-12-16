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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    $sql = "INSERT INTO pharmacy_suppliers (name, email, contact_number, address)
            VALUES ('$name', '$email', '$contact_number', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the main page after successful insertion
        header("Location: PharmacyAddSupplier.php"); // Change this to your main page file
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
