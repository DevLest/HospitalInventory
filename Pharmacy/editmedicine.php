<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $medicine_product = $_POST['medicine_product'];
    $image = $_POST['image'];
    $generic_name = $_POST['generic_name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $registered_quantity = $_POST['registered_quantity'];
    $registered = $_POST['registered'];
    $expiry = $_POST['expiry'];
    $selling_price = $_POST['selling_price'];

    // Update query
    $sql = "UPDATE pharmacy_medicines_products 
            SET medicine_product = ?, 
                image = ?, 
                generic_name = ?, 
                category = ?, 
                brand = ?, 
                registered_quantity = ?, 
                registered = ?, 
                expiry = ?, 
                selling_price = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssdi",
        $medicine_product,
        $image,
        $generic_name,
        $category,
        $brand,
        $registered_quantity,
        $registered,
        $expiry,
        $selling_price,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>
            alert('Product updated successfully!');
            window.location.href = 'Med_List.php'; // Replace with your table page URL
        </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>