<?php
require_once('../connection/dbconfig.php'); 


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    // Get the user ID from the form
    $user_id = $_POST['user_id'];

    // Sanitize the input
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM users WHERE id='$user_id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully.";
        // Optionally redirect back to the user list page or show a success message
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
