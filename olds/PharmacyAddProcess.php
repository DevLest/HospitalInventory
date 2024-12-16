<?php
// Database connection
$db = mysqli_connect('localhost', 'root', '', 'data') or die ('Unable to connect. Check your connection parameters.');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $customerName = $_POST['customerName'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $doctorName = $_POST['doctorName'];
    $doctorAddress = $_POST['doctorAddress'];

    // Insert customer data
    $query = "INSERT INTO pharmacycustomers (customer_name, contact_number, address) VALUES ('$customerName', '$contactNumber', '$address')";
    $result = mysqli_query($db, $query);

    if ($result) {
        $customerId = mysqli_insert_id($db);

        // Insert doctor data
        $query = "INSERT INTO pharmacydoctors (doctor_name, doctor_address) VALUES ('$doctorName', '$doctorAddress')";
        $result = mysqli_query($db, $query);

        if ($result) {
            echo "<script>alert('Data inserted successfully.');</script>";
            // Redirect to a confirmation page or any other page as needed
            header("Location: PharmacyAddCostu.php");
            exit();
        } else {
            echo "Error inserting record into doctors: " . mysqli_error($db);
        }
    } else {
        echo "Error inserting record into customers: " . mysqli_error($db);
    }
}

mysqli_close($db);
?>
