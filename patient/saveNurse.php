<?php
require_once('../connection/dbconfig.php'); 


// Prepare the data
$patient_name = $_POST['patient_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$admission_date = $_POST['admission_date'];
$attending_doctor = $_POST['attending_doctor'];
$condition_summary = $_POST['condition_summary'];

// Insert query
$sql = "INSERT INTO er_patient (patient_name, age, gender, contact_number, address, admission_date, attending_doctor, condition_summary) 
        VALUES ('$patient_name', '$age', '$gender', '$contact_number', '$address', '$admission_date', '$attending_doctor', '$condition_summary')";

if ($conn->query($sql) === TRUE) {
    header("Location: NurseAdd.php?success=1"); // Redirect back with a success query parameter
    exit;
} else {
    header("Location: NurseAdd.php?error=1"); // Redirect back with an error query parameter
    exit;
}

// Close the connection
$conn->close();
?>
