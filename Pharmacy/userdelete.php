<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die('Unable to connect to the database. Check your connection parameters.');
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    // Get the user ID from the form
    $user_id = $_POST['user_id'];

    // Sanitize the input
    $user_id = mysqli_real_escape_string($con, $user_id);

    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM users WHERE id='$user_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        echo "User deleted successfully.";
        // Optionally redirect back to the user list page or show a success message
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}
?>
