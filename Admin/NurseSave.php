<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $id = $_POST['id'];
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $admission_date = $_POST['admission_date'];
    $condition_summary = $_POST['condition_summary'];
    $attending_doctor = $_POST['attending_doctor'];
    $status = $_POST['status'];

$conn = new mysqli("localhost", "root", "", "database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL update query
    $sql = "UPDATE er_patient SET 
                patient_name = ?, 
                age = ?, 
                gender = ?, 
                contact_number = ?, 
                address = ?, 
                admission_date = ?, 
                condition_summary = ?, 
                attending_doctor = ?, 
                status = ? 
            WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("sisssssssi", 
            $patient_name, 
            $age, 
            $gender, 
            $contact_number, 
            $address, 
            $admission_date, 
            $condition_summary, 
            $attending_doctor, 
            $status, 
            $id
        );

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to Nurselist.php after successful update
            header('Location: Nurselist.php');
            exit; // Stop further execution
        } else {
            // Handle failure
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle error preparing the statement
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case if the form is not submitted via POST
    echo "Invalid request.";
}
?>
