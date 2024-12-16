<?php
// Start the session
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';  // Your database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die('Unable to connect to the database. Check your connection parameters.');
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $shift = $_POST['shift'];

    // Sanitize input
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $shift = mysqli_real_escape_string($conn, $shift);

    // Prepare the SQL query to update the user
    $sql = "UPDATE users SET 
                username = '$username', 
                email = '$email', 
                shift = '$shift' 
            WHERE id = '$user_id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Store a success message in the session
        $_SESSION['success_message'] = "User updated successfully.";

        // Redirect to the ManageUser.php page
        header("Location: ManageUser.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
