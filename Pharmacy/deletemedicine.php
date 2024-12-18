<?php
require_once('../connection/dbconfig.php'); 


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete query
    $sql = "DELETE FROM pharmacy_medicines_products WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: Med_list.php"); // Redirect to the main page
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>
