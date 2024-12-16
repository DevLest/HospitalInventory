<?php
require_once('../connection/dbconfig.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_product = htmlspecialchars($_POST['medicine_product']);
    $generic_name = htmlspecialchars($_POST['generic_name']);
    $category = htmlspecialchars($_POST['category']);
    $brand = htmlspecialchars($_POST['brand']);
    $registered_quantity = htmlspecialchars($_POST['registered_quantity']);
    $expiry = htmlspecialchars($_POST['expiry']);
    $selling_price = htmlspecialchars($_POST['selling_price']);
    $registered = date('Y-m-d'); // Automatically generate today's date for 'registered'

    // Assign remain_quantity the same value as registered_quantity
    $remain_quantity = $registered_quantity;

    // Handle file upload
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $upload_ok = true;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Validate file type and size
    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($image_type, ["jpg", "jpeg", "png", "gif"])) {
        echo "Invalid file type. Only JPG, JPEG, PNG & GIF allowed.<br>";
        $upload_ok = false;
    }
    if ($_FILES["image"]["size"] > 2000000) { // 2MB size limit
        echo "File is too large. Max size is 2MB.<br>";
        $upload_ok = false;
    }

    if ($upload_ok && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image uploaded successfully.<br>";
    } else {
        die("Error uploading the image.<br>");
    }

    // Prepare and execute SQL query
    $query = "INSERT INTO pharmacy_medicines_products 
        (medicine_product, image, generic_name, category, brand, registered_quantity, remain_quantity, registered, expiry, selling_price) 
        VALUES ('$medicine_product', '$target_file', '$generic_name', '$category', '$brand', '$registered_quantity', '$remain_quantity', '$registered', '$expiry', '$selling_price')";

    if ($conn->query($query) === TRUE) {
         echo '<script type="text/javascript">
            setTimeout(function() {
                window.location.href = "PharmacyMedicineList.php"; // Replace with the actual path to your dashboard
            }, 2000); // 2000 milliseconds = 2 seconds
        </script>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
