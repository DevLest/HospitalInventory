<?php
require_once('../connection/dbconfig.php'); 


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $image = $_POST['image'];
    $product = $_POST['product'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $date_registered = $_POST['date_registered'];
    $selling_price = $_POST['selling_price'];
    $registered_quantity = $_POST['registered_quantity'];

    // Update query
    $sql = "UPDATE pharmacy_products
            SET image = ?, 
                product = ?, 
                category = ?, 
                brand = ?, 
                date_registered = ?, 
                selling_price = ?, 
                registered_quantity = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssdsi",
        $image,
        $product,
        $category,
        $brand,
        $date_registered,
        $selling_price,
        $registered_quantity,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>
            alert('Product updated successfully!');
            window.location.href = 'PharmacyProductList.php'; // Replace with your table page URL
        </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

?>
