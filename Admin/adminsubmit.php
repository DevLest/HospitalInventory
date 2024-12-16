<?php
require_once('../connection/dbconfig.php'); 


// Function to add a new Chief Admin
function addChiefAdmin($name, $username, $password, $email, $chief_license, $contact_number, $address) {
    global $conn;

    // Escape form input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);
    $chief_license = mysqli_real_escape_string($conn, $chief_license);
    $contact_number = mysqli_real_escape_string($conn, $contact_number);
    $address = mysqli_real_escape_string($conn, $address);

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL query
    $query = "INSERT INTO chief_admins (username, password, email, chief_license, contact_number, address, created_at) 
              VALUES ('$username', '$hashedPassword', '$email', '$chief_license', '$contact_number', '$address', NOW())";

    // Execute the query and check for success
    if (mysqli_query($conn, $query)) {
        return "Chief Admin added successfully!";
    } else {
        return "Error: " . mysqli_error($conn);
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $chief_license = $_POST['chief_license'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];

    // Call the function to insert data
    $message = addChiefAdmin($name, $username, $password, $email, $chief_license, $contact_number, $address);
    echo $message;  // Display the success or error message
}
?>
