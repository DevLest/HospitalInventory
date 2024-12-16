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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product = $_POST['product'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $registered_quantity = $_POST['registered_quantity'];
    $date_registered = $_POST['date_registered'];
    $selling_price = $_POST['selling_price'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; // Directory to save the uploaded images
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image is a valid format (optional)
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_file_type, $allowed_types)) {
            die("Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Move uploaded file to the server
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            die("There was an error uploading the image.");
        }
    } else {
        die("Image is required.");
    }

    // Insert data into the database
    $sql = "INSERT INTO pharmacy_products (image, product, category, brand, date_registered, selling_price, registered_quantity)
            VALUES ('$target_file', '$product', '$category', '$brand', '$date_registered', '$selling_price', '$registered_quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
